<!DOCTYPE html>
<html lang="pt-br">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Listar Modal</title>
  </head>
  <body>
          <div class="container">
              <h1>Listar as categorias</h1>
              <span id="msgAlerta"></span>

              <div class="row">
                <div class="col-lg-12">
                  <span class="listar-categorias"></span>
                </div>
              </div>
              
          </div>

          <!-- Modal -->
                <div class="modal fade" id="listarProdutosModal" tabindex="-1" aria-labelledby="listarProdutosLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="listarProdutosLabel">Listar Produtos</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                             <span id="msgErroListProd"></span>
                              <span class="listar-produtos"></span>                                 
                              <div class="modal-footer">          
                            </div> 
                          </div>      
                        </div>
                      </div>
                    </div>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>

  </body>
</html>