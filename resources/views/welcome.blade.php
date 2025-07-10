<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - API Docs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .request-example {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        pre {
            margin: 0;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">

        <div class="text-center mb-5">
            <h1 class="display-4 d-flex align-items-center justify-content-center">
                <img src="https://www.cbclubes.org.br/files/files/inline-images/logo_CBC_211110_cinza.png" 
                    alt="Logo Comitê Brasileiro de Clubes" 
                    class="me-3"
                    style="height: 60px; width: auto;">
            </h1>
            <p class="lead">Documentação da API</p>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5>GET /api/listar-clubes</h5>
                <p class="mb-0">Lista todos os clubes</p>
            </div>
            
            <div class="card-body">
                <div class="request-example">
                    <h6>📌 Exemplo de Requisição:</h6>
                    <div class="p-2">
                        <code>
                            curl -X GET <br>
                            -H "Accept: application/json"<br>
                            http://{{ request()->getHost() }}/api/listar-clubes <br>
                        </code>
                   </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5>POST /api/cadastrar-clubes</h5>
                <p class="mb-0">Cadastra um clube</p>
            </div>
            
            <div class="card-body">
                <div class="request-example">
                    <h6>📌 Exemplo de Requisição:</h6>
                    <div class="p-2">
                        <code>
                            curl -X POST <br>
                            -H "Accept: application/json"<br>
                            http://{{ request()->getHost() }}/api/listar-clubes <br>
                            -d '{
                                    "clube": "Clube Exemplo 1",
                                    "saldo_disponivel": "1000,00"
                                }' 
                        </code>
                   </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5>POST /api/consumir-recursos</h5>
                <p class="mb-0">Consome recurso do clube e do recurso</p>
            </div>
            
            <div class="card-body">
                <div class="request-example">
                    <h6>📌 Exemplo de Requisição:</h6>
                    <div class="p-2">
                        <code>
                            curl -X POST <br>
                            -H "Accept: application/json"<br>
                            http://{{ request()->getHost() }}/api/consumir-recursos <br>
                            -d '{
                                 
                                    "clube_id":"1", 
                                    "recurso_id":"1", 
                                    "valor_consumo":"500,00" 
                        
                                }' 
                        </code>
                   </div>
                </div>
            </div>
            
        </div>

        <footer class="mt-5 text-center text-muted">
            <p>© {{ date('Y') }} API Comitê Brasileiro de Clubes - Versão {{ config('app.version', '1.0') }}</p>
        </footer>
    </div>
</body>
</html>