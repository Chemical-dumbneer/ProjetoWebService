<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento ao Cliente - Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="custom_styles.css"> 
</head>
<body>
    <div class="container-fluid py-4 bg-light min-vh-100">
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="p-3 bg-white shadow-sm rounded border h-100">
                    <h5 class="mb-3 text-secondary">Mensagens do Cliente</h5>
                    
                    <div class="card p-3 mb-3 border-start border-3 border-primary bg-light">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <span class="rounded-circle bg-info text-white me-3" style="width:40px; height:40px; display:flex; justify-content:center; align-items:center;">F</span>
                                <strong class="text-primary">Fulano da Silva</strong>
                            </div>
                            <small class="text-muted">11/03/2025 07:20</small>
                        </div>
                        <div class="mt-2">
                            <h6 class="card-title text-danger">Meu PC não liga</h6>
                            <p class="card-text">Ontem eu desliguei o modem pra carregar o celular e agora minha internet não funciona. Preciso que me ajudem!</p>
                        </div>
                    </div>
                    
                    </div>
            </div>

            <div class="col-lg-4 d-flex flex-column">
                
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-secondary btn-sm flex-fill me-2" data-type="acompanhamento">+ Acompanhamento</button>
                    <button class="btn btn-warning btn-sm flex-fill me-2" data-type="tarefa">+ Tarefa</button>
                    <button class="btn btn-primary btn-sm flex-fill" data-type="solucao">+ Solução</button>
                </div>

                <div class="d-grid gap-2 mb-3">
                    <div class="p-2 border rounded bg-secondary-subtle text-dark d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Acompanhamento</strong> <small class="text-muted">11/03/2025 07:20</small>
                        </div>
                        <span class="rounded-circle bg-secondary text-white" style="width:25px; height:25px; font-size: 0.8rem; display:flex; justify-content:center; align-items:center;">T</span>
                    </div>
                    <div class="p-2 border rounded bg-warning-subtle text-dark d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Tarefa</strong> <small class="text-muted">11/03/2025 07:20</small>
                        </div>
                         <span class="rounded-circle bg-warning text-dark" style="width:25px; height:25px; font-size: 0.8rem; display:flex; justify-content:center; align-items:center;">T</span>
                    </div>
                    <div class="p-2 border rounded bg-primary-subtle text-dark d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Solução</strong> <small class="text-muted">11/03/2025 07:20</small>
                        </div>
                        <span class="rounded-circle bg-primary text-white" style="width:25px; height:25px; font-size: 0.8rem; display:flex; justify-content:center; align-items:center;">T</span>
                    </div>
                </div>

                <div class="card p-3 shadow-sm mt-auto">
                    <h6 class="card-title">Descrever Ação</h6>
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" placeholder="descrever ação" rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-success me-2">Inserir</button>
                            <button type="button" class="btn btn-secondary me-3">Cancelar</button>
                            
                            <span class="rounded-circle bg-dark text-white" style="width:30px; height:30px; font-size: 0.8rem; display:flex; justify-content:center; align-items:center;">T</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>