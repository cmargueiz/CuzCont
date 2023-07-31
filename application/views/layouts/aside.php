        <!-- =============================================== -->

        <Body class="nav-md">
            <div class="container body">
                <div class="main_container">
                    <div class="col-md-3 left_col">
                        <div class="left_col scroll-view">
                            <div class="navbar nav_title" style="border: 0;">
                                <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Coop. Cuzca</span></a>
                            </div>

                            <div class="clearfix"></div>

                            <!-- menu profile quick info -->
                            <div class="profile clearfix">


                            </div>
                            <!-- /menu profile quick info -->

                            <br />

                            <!-- sidebar menu -->
                            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                                <div class="menu_section">

                                    <ul class="nav side-menu">

                                        <li class=""><a><i class="fa fa-home"></i> Facturas <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none;">
                                                <li><a href="<?php echo base_url();?>mhdte/cuerpodocumento/?Cat=CC">Factura Venta Cafe</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/cuerpodocumento/?Cat=CF">Factura Ferreteria </a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/cuerpodocumento/?Cat=CO">Factura Consignacion</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/cuerpodocumento/fcof/?Cat=OF">Factura Oficina</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/cuerpodocumento/fgas/?Cat=CG">Factura Combustible</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/cuerpodocumento/FacturaExp/?Cat=EX">Factura Exportacion</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/ServiciosGenerales/">FSExcluido Compra</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/ServiciosGenerales/fsep">FSExcluido Pagos</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/ServiciosGenerales/comrete">Comp. Retencion</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/ServiciosGenerales/Notcredi">Nota de Credito</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/comprasComp/">Ingresos de Compra</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/ServiciosGenerales/NotRemicion">Nota de Remisión</a></li>
                                                <li><a href="<?php echo base_url();?>mhdte/Integracion/">Autenticar en MH</a></li>

                                            </ul>
                                        </li>
                                        <li class=""><a><i class="fa fa-home"></i> Integraciones <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none;">
                                               
                                                <li><a href="<?php echo base_url();?>mhdte/Integracion/IntegraCobol">Envio de DTE a Cobol</a></li>

                                            </ul>
                                        </li>

                                    </ul>
                                </div>


                            </div>
                            <!-- /sidebar menu -->

                        </div>
                    </div>

                    <!-- top navigation -->
                    <div class="top_nav">
                        <div class="nav_menu">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <nav class="nav navbar-nav">
                                <ul class=" navbar-right">
                                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-sign-out pull-right"><?php echo $this->session->userdata("nombre")?> </i>
                                        </a>
                                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                                            <a class="dropdown-item" href="<?php echo base_url(); ?>auth/logout"> Cerrar Sesión </a>
                                        </div>
                                    </li>


                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /top navigation -->


                    <!-- =============================================== -->
