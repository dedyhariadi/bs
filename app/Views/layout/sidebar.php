 <nav id="desktopSidebar" class="col-md-3 col-lg-2 d-none d-md-block sidebar-fixed">
     <div class="position-sticky">
         <h5 class="text-white text-center mb-4 mt-n5">Blackshark</h5>
         <ul class="nav flex-column sidebar-nav">
             <li class="nav-item">
                 <?= anchor('/', '<i class="bi bi-house-door"></i> Home', ['class' => 'nav-link active']); ?>
             </li>
             <br>
             <li class="nav-header">MAIN</li>

             <li class="nav-item">
                 <?= anchor('torpedo', '<i class="nav-icon bi bi-download"></i>Torpedo', ['class' => 'nav-link']); ?>
             </li>
             <li class="nav-item">
                 <?= anchor('torpedo', '<i class="nav-icon bi bi-grip-horizontal"></i>Alat Test', ['class' => 'nav-link']); ?>
             </li>


             <br>
             <li class="nav-header">SUPPORTS</li>
             <li class="nav-item">
                 <a href="bukumerah" class="nav-link">
                     <i class="nav-icon bi bi-bookmark-star"></i>
                     Buku Merah
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-bs-toggle="collapse" href="#submenuProdukDesktop" role="button" aria-expanded="false" aria-controls="submenuProdukDesktop">
                     <i class="nav-icon bi bi-book-half"></i> Manual Book
                     <i class="bi bi-chevron-right ms-auto dropdown-arrow"></i>
                 </a>
                 <div class="collapse" id="submenuProdukDesktop">
                     <ul class="nav flex-column">
                         <li class="nav-item">
                             <?php
                                $jenisManual = 'torpedo';
                                ?>
                             <?= anchor('home/manual/' . $jenisManual, 'Torpedo', ['class' => 'nav-link']); ?>
                         </li>

                         <li class="nav-item">
                             <?php
                                $jenisManual = 'alattest';
                                ?>
                             <?= anchor('home/manual/' . $jenisManual, 'Alat Test', ['class' => 'nav-link']); ?>
                         </li>


                     </ul>
                 </div>
             </li>

             <li class="nav-item">
                 <a href="spareparts" class="nav-link">
                     <i class="nav-icon bi bi-tools"></i>
                     Spareparts
                 </a>
             </li>

             <li class="nav-item mt-auto">
                 <a class="nav-link" data-bs-toggle="collapse" href="#submenuJurnal" role="button" aria-expanded="false" aria-controls="submenuJurnal">
                     <i class="bi bi-person-circle"></i> Jurnal
                     <i class="bi bi-chevron-right ms-auto dropdown-arrow"></i>
                 </a>
                 <div class="collapse" id="submenuJurnal">
                     <ul class="nav flex-column">
                         <li class="nav-item"><a class="nav-link" href="#">Harian</a></li>
                         <li class="nav-item"><a class="nav-link" href="#">Khusus</a></li>
                     </ul>
                 </div>
             </li>

             <li class="nav-item mt-auto">
                 <a class="nav-link" data-bs-toggle="collapse" href="#submenuOthers" role="button" aria-expanded="false" aria-controls="submenuOthers">
                     <i class="bi bi-person-circle"></i> Others
                     <i class="bi bi-chevron-right ms-auto dropdown-arrow"></i>
                 </a>
                 <div class="collapse" id="submenuOthers">
                     <ul class="nav flex-column">
                         <li class="nav-item"><a class="nav-link" href="#">TPO Countermeasure</a></li>
                         <li class="nav-item"><a class="nav-link" href="#">Kas Testbench</a></li>
                         <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
                     </ul>
                 </div>
             </li>

         </ul>
     </div>
 </nav>