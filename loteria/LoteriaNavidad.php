<?php

// LoteriaNadivad.php
class LoteriaNavidad {
    private $numeros = [];

    public function __construct() {
        $this->cargarNumeros();
    }

    private function cargarNumeros() {
        if (file_exists(Config::ARCHIVO_NUMEROS)) {
            $this->numeros = json_decode(file_get_contents(Config::ARCHIVO_NUMEROS), true) ?? [];
        }
    }

    private function guardarNumeros() {
        file_put_contents(Config::ARCHIVO_NUMEROS, json_encode($this->numeros));
    }

    public function agregarNumero($numero, $participacion) {
        if (!preg_match('/^\d{5}$/', $numero)) {
            throw new Exception("El número debe tener exactamente 5 dígitos");
        }

        if (!is_numeric($participacion) || $participacion <= 0) {
            throw new Exception("La participación debe ser un número positivo");
        }

        $this->numeros[] = [
            'numero' => $numero,
            'participacion' => (float)$participacion,
            'fecha_registro' => date('Y-m-d H:i:s')
        ];

        $this->guardarNumeros();
    }

    public function obtenerNumeros() {
        return $this->numeros;
    }

    public function comprobarPremios() {
        try {
            $ch = curl_init(Config::API_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            
            if ($response === false) {
                throw new Exception(curl_error($ch));
            }
            
            curl_close($ch);
            $premios = json_decode($response, true);

            $resultados = [];
            foreach ($this->numeros as $numero) {
                foreach ($premios as $premio) {
                    if ($numero['numero'] === $premio['numero']) {
                        $premioTotal = $premio['premio_por_euro'] * $numero['participacion'];
                        $resultados[] = [
                            'numero' => $numero['numero'],
                            'participacion' => $numero['participacion'],
                            'premio' => $premioTotal,
                            'categoria' => $premio['categoria']
                        ];
                    }
                }
            }
            
            return $resultados;
            
        } catch (Exception $e) {
            error_log("Error al comprobar premios: " . $e->getMessage());
            return [];
        }
    }
}

// index.php
session_start();

require_once 'Config.php';
require_once 'LoteriaNavidad.php';

$loteria = new LoteriaNavidad();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $numero = $_POST['numero'] ?? '';
        $participacion = $_POST['participacion'] ?? '';
        
        $loteria->agregarNumero($numero, $participacion);
        $mensaje = "Número agregado correctamente";
        
    } catch (Exception $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}

$numeros = $loteria->obtenerNumeros();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotería de Navidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">Gestor de Lotería de Navidad</h1>
        
        <?php if ($mensaje): ?>
            <div class="alert alert-info" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Agregar Número</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número (5 dígitos)</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="numero" 
                                       name="numero" 
                                       pattern="\d{5}" 
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="participacion" class="form-label">Participación (€)</label>
                                <input type="number" 
                                       class="form-control" 
                                       id="participacion" 
                                       name="participacion" 
                                       step="0.01" 
                                       min="0.01" 
                                       required>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Números Registrados</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($numeros)): ?>
                            <p class="text-muted">No hay números registrados</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Participación</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($numeros as $numero): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($numero['numero']); ?></td>
                                                <td><?php echo htmlspecialchars($numero['participacion']); ?>€</td>
                                                <td><?php echo htmlspecialchars($numero['fecha_registro']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script para comprobar premios automáticamente -->
        <div class="mt-4">
            <button id="iniciarComprobacion" class="btn btn-success">
                Iniciar Comprobación de Premios
            </button>
            <div id="resultadosPremios" class="mt-3"></div>
        </div>
    </div>

    <script>
    document.getElementById('iniciarComprobacion').addEventListener('click', function() {
        let comprobando = true;
        this.textContent = 'Detener Comprobación';
        
        function comprobarPremios() {
            if (!comprobando) return;

            fetch('comprobar_premios.php')
                .then(response => response.json())
                .then(data => {
                    const resultados = document.getElementById('resultadosPremios');
                    if (data.length > 0) {
                        let html = '<div class="alert alert-success"><h4>¡Premios encontrados!</h4>';
                        data.forEach(premio => {
                            html += `
                                <p>Número: ${premio.numero}<br>
                                Participación: ${premio.participacion}€<br>
                                Premio: ${premio.premio}€<br>
                                Categoría: ${premio.categoria}</p>
                            `;
                        });
                        html += '</div>';
                        resultados.innerHTML = html;
                    } else {
                        resultados.innerHTML = '<div class="alert alert-info">No se han encontrado premios todavía.</div>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            setTimeout(comprobarPremios, 60000); // Comprobar cada minuto
        }

        this.addEventListener('click', function() {
            comprobando = !comprobando;
            this.textContent = comprobando ? 'Detener Comprobación' : 'Iniciar Comprobación de Premios';
            if (comprobando) comprobarPremios();
        });

        comprobarPremios();
    });
    </script>
</body>
</html>

<?php
// comprobar_premios.php
require_once 'Config.php';
require_once 'LoteriaNavidad.php';

header('Content-Type: application/json');

$loteria = new LoteriaNavidad();
echo json_encode($loteria->comprobarPremios());
?>