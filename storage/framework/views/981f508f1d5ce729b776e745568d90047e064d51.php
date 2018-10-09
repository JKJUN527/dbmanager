<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title">
                <i class="fa fa-cloud"></i>
                <span>DB-Manager</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            
                
            
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>功能区</h3>
                <ul class="nav side-menu">
                    <li <?php if($activeIndex == 1): ?> class="active" <?php endif; ?>>
                        <a href="/db/vender">
                            <i class="fa fa-edit"></i> 厂家管理
                        </a>
                    </li>
                    <li <?php if($activeIndex == 0): ?> class="active" <?php endif; ?>>
                        <a>
                            <i class="fa fa-home"></i> DBManager <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li <?php if($activeIndexSecend == 0): ?> class="current-page" <?php endif; ?>><a href="/db/table1">集中器/采集器</a></li>
                            <li <?php if($activeIndexSecend == 1): ?> class="current-page" <?php endif; ?>><a href="/db/table2">户表</a></li>
                            <li <?php if($activeIndexSecend == 2): ?> class="current-page" <?php endif; ?>><a href="/db/table3">低压互感器</a></li>
                            <li <?php if($activeIndexSecend == 3): ?> class="current-page" <?php endif; ?>><a href="/db/table4">高压互感器</a></li>
                            <li <?php if($activeIndexSecend == 4): ?> class="current-page" <?php endif; ?>><a href="/db/table5">组合式互感器</a></li>
                            <li <?php if($activeIndexSecend == 5): ?> class="current-page" <?php endif; ?>><a href="/db/table6">计量箱</a></li>
                            <li <?php if($activeIndexSecend == 6): ?> class="current-page" <?php endif; ?>><a href="/db/table7">专变终端</a></li>
                        </ul>
                    </li>
                    <li <?php if($activeIndex == 2): ?> class="active" <?php endif; ?>>
                        <a>
                            <i class="fa fa-table"></i> 变更记录
                        </a>
                    </li>
                    
                        
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                        
                    
                    
                        
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                        
                    
                
            
            
                
                
                    
                        
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                
                            
                            
                            
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        
            
                
            
            
                
            
            
                
            
            
                
            
        
        <!-- /menu footer buttons -->
    </div>
</div>