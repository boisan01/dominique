<div id="content" class="content">
  <ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url('Ujian');?>">DOSEN</a></li>
  </ol>
<h1 class="page-header">Data Surat Keputusan Rektor</h1>
  <div class="row">
    <div class="col-xl-12">
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <h4 class="panel-title">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah" >Tambah</button>
          </h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
        </div>
      </div>
        <div class="card-body">
							<div class="row">
              <div class="col-xl-7 col-lg-8">
                                    <?php if($this->session->flashdata('notifpagu') != NULL){ ?>
                                      <div class="alert alert-success alert-dismissible">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong>Notif!</strong> <?php echo $this->session->flashdata('notifpagu') ?>
                                    </div>
                                    <?php } ?>
                                    <form method="POST" action="<?php echo base_url() ?>Ujian/uploadPagu" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail2">Pengunggahan File</label>
                                            <span class="ml-2">
                                                <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Format yang diupload .xlsx" data-placement="top" data-content=""></i>
                                            </span>
                                            <input for="pagu" type="file" name="pagu" class="form-control">
                                        </div>

                                        <button id="pagu" type="submit" class="btn btn-success">Upload</button>
                                    </form>
                                </div>            
                            </div>
                        </div>
                    <?php if($this->session->flashdata('error') != NULL){ ?>
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Notif!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                    <?php } ?>
                    
        <div class="panel-body">
        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
              <tr>
                <th class="text-nowrap">NO</th>
                <th class="text-nowrap">ID Kategori</th>
                <th class="text-nowrap">Tentang</th>
                <th class="text-nowrap">Status</th>
                <th class="text-nowrap">Tahun</th>
                <th class="text-nowrap">Nomor</th>
                <th class="text-nowrap">Nama Kategori</th>
                <th>Aksi</th> <!--field untuk menunjukan delete dan edit -->
              <!-- kode di atas adalah penamaan header di tabel -->
              </tr>
            </thead>
            <tbody>
            <?php 
              $no = 0;
              foreach($data as $dom){
              $no++;  
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <!-- <td><?php echo $dom->id_prokum; ?></td> -->
                <td><?php echo $dom->id_kategori; ?></td>
                <td><?php echo substr($dom->tentang, strpos($dom->tentang, "2020 ") + 4); ?></td>
                <td><?php echo $dom->status; ?></td>
                <td><?php echo $dom->tahun; ?></td>  
                <td><?php echo $dom->nomor; ?></td>
                <td><?php echo $dom->nama_kat; ?></td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $dom->id_prokum;?>"><i class="fas fa-edit"></i></button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?php echo $dom->id_prokum;?>"><i class="fas fa-trash"></i></button> <!--pakai library -->
                </td>
              <!-- kode di atas mengacu pada nama-nama field di database  -->
            </tr>
            
<!-- Modal EDIT -->

    <div class="modal fade" id="edit<?php echo $dom->id_prokum;?>" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Data Surat Keputusan Rektor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                        <div class="modal-body">
                          <form method="post" action="Ujian/edit_tester">
                            
                            <!-- Form -->
                              <input type="hidden" name="id_prokum" value="<?php echo $dom->id_prokum;?>" required>
                                <div class="form-group">
                                    <label class="col-form-label">ID_Kategori:</label>
                                       <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?php echo $dom->id_kategori;?>" readonly required>
                                </div>
                            
                                <div class="form-group">
                                  <label class="col-form-label">Tentang:</label>
                                    <input type="text" class="form-control" id="tentang" name="tentang" value="<?php echo $dom->tentang;?>">
                                </div>

                                <div class="dropdown">
                                  <label class="col-form-label">Status:</label>
                                    <select name="status" class="form-control">
                                      <option value="<?php echo $dom->status;?>" selected ><?php echo $dom->status;?></option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            
                                <div class="form-group">
                                  <label class="col-form-label">Tahun:</label>
                                    <input type="text" class="form-control" id="tahun" name="tahun" value="<?php echo $dom->tahun;?>">
                                </div>

                                <div class="form-group">
                                  <label class="col-form-label">Nomor:</label>
                                  <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $dom->nomor;?>">
                                </div>
                            
                                <div class="form-group">
                                  <label class="col-form-label">Nama Kategori:</label>
                                  <textarea class="form-control" id="nama_kat" name="nama_kat"><?php echo $dom->nama_kat;?></textarea>
                                </div>
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>  

<!-- End Edit -->
            
<!-- Modal DELETE -->

            <div class="modal fade" id="hapus<?php echo $dom->id_prokum;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Surat Keputusan Rektor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Pengen banget hapus SK Rektor Nomor (<?php echo $dom->nomor ?>) ?</p>
                    <form method="post" action="Ujian/hapus_tester">
                      
                      <!-- Form -->
                        <input type="hidden" name="id_prokum" value="<?php echo $dom->id_prokum;?>">
                      <!-- End Form -->

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                  </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>  

<!-- End DELETE -->

            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- end panel-body -->
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-10 -->    
</div>


<!-- Modal Tambah -->

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Surat Keputusan Rektor:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
                <div class="modal-body">
                  <form method="post" action="Ujian/tambah_tester">
                    <div class="form-group">
                      <label class="col-form-label">ID Kategori:</label>
                      <input type="number" class="form-control" id="id_kategori" name="id_kategori" required>
                    </div>
                   
                    <div class="form-group">
                      <label class="col-form-label">Tentang:</label>
                      <input type="text" class="form-control" id="tentang" name="tentang" required>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-form-label">Tahun:</label>
                      <input type="text" class="form-control" id="tahun" name="tahun" required>
                    </div>
                      
                    <div class="form-group">
                      <label class="col-form-label">Status:</label>
                      <select name="status" class="form-control">
                        <option value="">Pilih...</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-form-label">Nomor:</label>
                      <input type="text" class="form-control" id="nomor" name="nomor" required>
                    </div>

                    <div class="form-group">
                      <label class="col-form-label">Nama Kategori:</label>
                      <input type="text" class="form-control" id="nama_kat" name="nama_kat" required>
                    </div>
                          
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- End Modal Tambah -->