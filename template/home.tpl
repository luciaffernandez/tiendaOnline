<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}
        <section>
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item slide-1 active">
                        <div class="carousel-caption">
                            <h2>First Slide</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting 
                                industry. Lorem Ipsum has been the industry's standard dummy text 
                                ever since the 1500s, when an unknown printer took a galley of type 
                                and scrambled it to make a type specimen book. It has survived not 
                                only five centuries, but also the leap into electronic typesetting, 
                                remaining essentially unchanged.</p>
                            <button class="btn-complejo col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="circle">
                                    <span class="icon arrow"></span>
                                </div>
                                <p class="button-text">LEER MÁS</p>
                            </button>
                        </div>
                    </div>
                    <div class="carousel-item slide-2">
                        <div class="carousel-caption">
                            <h2>Second Slide</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting 
                                industry. Lorem Ipsum has been the industry's standard dummy text 
                                ever since the 1500s, when an unknown printer took a galley of type 
                                and scrambled it to make a type specimen book. It has survived not 
                                only five centuries, but also the leap into electronic typesetting, 
                                remaining essentially unchanged.</p>
                            <button class="btn-complejo col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="circle">
                                    <span class="icon arrow"></span>
                                </div>
                                <p class="button-text">LEER MÁS</p>
                            </button>
                        </div>
                    </div>
                    <div class="carousel-item slide-3">
                        <div class="carousel-caption">
                            <h2>Third Slide</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting 
                                industry. Lorem Ipsum has been the industry's standard dummy text 
                                ever since the 1500s, when an unknown printer took a galley of type 
                                and scrambled it to make a type specimen book. It has survived not 
                                only five centuries, but also the leap into electronic typesetting, 
                                remaining essentially unchanged.</p>
                            <button class="btn-complejo col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="circle">
                                    <span class="icon arrow"></span>
                                </div>
                                <p class="button-text">LEER MÁS</p>
                            </button>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <section class="espacio"></section>
        <section>
            <div class="seccionMargenes col-lg-10 col-md-10 col-xs-10 col-sm-10">
                <div class="row text-center">
                    <div class="col-md-3 ">
                        <a class="btn-floating">
                            <img src="images/icon1.png" class="iconosHome" />
                        </a>
                        <div class="info">
                            <h3>CARACTERÍSTICA 1</h3>
                            <p class="textoNormal">Lorem Ipsum is simply dummy text of the printing and typesetting 
                                industry.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a class="btn-floating">
                            <img src="images/icon2.png" class="iconosHome" />
                        </a>
                        <div class="info">
                            <h3>CARACTERÍSTICA 2</h3>
                            <p class="textoNormal">Lorem Ipsum is simply dummy text of the printing and typesetting 
                                industry.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a class="btn-floating">
                            <img src="images/icon3.png" class="iconosHome" />
                        </a>
                        <div class="info">
                            <h3>CARACTERÍSTICA 3</h3>
                            <p class="textoNormal">Lorem Ipsum is simply dummy text of the printing and typesetting 
                                industry.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a class="btn-floating">
                            <img src="images/icon4.png" class="iconosHome" />
                        </a>
                        <div class="info">
                            <h3>CARACTERÍSTICA 4</h3>
                            <p class="textoNormal">Lorem Ipsum is simply dummy text of the printing and typesetting 
                                industry.</p>
                        </div>
                    </div>
                </div>
                <section class="espacioPequeno"></section>
                <div class="justify-content-between">
                    <h4 class="float-left col-lg-8 col-md-12 col-sm-12 col-xs-12">Quieres conocernos un poco mejor o tienes alguna duda de los servicios que ofrecemos. Visita esta sección.</h4>
                    <button class="btn-complejo col-lg-3 col-md-12 col-sm-12 col-xs-12" onclick="location.href = 'sobreNosotros.php'">
                        <div class="circle">
                            <span class="icon arrow"></span>
                        </div>
                        <p class="button-text btn-sobre-nosotros">SOBRE NOSOTROS</p>
                    </button>
                </div>
            </div>
        </section>
        <section class="espacio"></section>
        <section class="fotoPortada row col-lg-12 col-sm-12 col-xs-12 col-md-12">
            <div>
                <h1>Título grande que se situaría en la parte principal de la web</h1>
            </div>
        </section>
        <section class="espacio"></section>
        {include file = "footer.tpl"}
</html>