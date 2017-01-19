<?php require("header.php"); ?>

    <!-- Page Content -->
    <div class="container">
        <br><br>
        <!-- Side Right -->
        <div class="col-md-12">
            <div id="breadcrumb">
                <ol class="breadcrumb" >
                  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                  <li class="active">Konfirmasi Pembayaran</li>
                </ol>
            </div>
        </div>

        <div class="col-md-12">
                <div class="col-md-12" style="margin:0;">
                    <h1 style="margin:0 0 10px 0;">Konfirmasi Pembayaran</h1>
                    <hr>
                </div>
                <div class="col-md-12">
                <?php if($this->session->flashdata("confirm") == "false" || $this->session->flashdata("confirm") == ""){ ?>
                    <?php if($this->session->flashdata("note") != ""){ ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata("note"); ?></div>
                    <?php 
                        $data = $this->session->flashdata("post");
                    } else {
                        $data = array(
                            'transactioncode' => '',
                            'tanggal' => '',
                            'kerekening' => '',
                            'atasnamapengirim' => '',
                            'jumlah' => ''
                        );
                    } 
                    ?>
                    <form action="<?php echo base_url() ?>konfirmasi_pembayaran/save" method="post">
                    <div class="form-group">
                        <label>Kode Invoice</label>
                        <input type="text" name="kode" class="form-control" required value="<?php echo $data['transactioncode']?>">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transfer</label>
                        <input type="text" name="tanggal" class="form-control" required value="<?php echo $data['tanggal']?>" >
                    </div>
                    <div class="form-group">
                        <label>Ke Bank</label>
                        <select name="kebank" class="form-control" required value="<?php echo $data['kerekening']?>" >
                            <option value="">[ Pilih ]</option>
                            <?php
                            foreach ($bank->result_array() as $key) {
                                # code...
                                $dump = explode(" | ", $key['options']);
                                $select = $data['kerekening'];

                                if($select == $key['parametervaluecode']){
                                    $sel = 'selected="selected"';
                                } else {
                                    $sel = '';
                                }
                                echo '<option value="'.$key['parametervaluecode'].'" '.$sel.' >'.$dump[0].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Atas Nama Pengirim</label>
                        <input type="text" name="an" class="form-control" required value="<?php echo $data['atasnamapengirim']?>">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" required  value="<?php echo $data['jumlah']?>" >
                    </div>
                    <div class="form-group">
                        <?php
                        $vals = array(
                            'img_path'  => './captcha/',
                            'img_url'   => base_url() . 'captcha/'
                            );

                        $cap = create_captcha($vals);

                        $data = array(
                            'captcha_time'  => $cap['time'],
                            'ip_address'    => $this->input->ip_address(),
                            'word'  => $cap['word']
                            );

                        $query = $this->db->insert_string('captcha', $data);
                        $this->db->query($query);

                        echo '<label>Submit the word you see below:</label>';
                        echo $cap['image'];
                        echo '<input type="text" name="captcha" id="captcha" value="" class="form-control" required="required" />';
                        ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    <?php } else { ?>
                        <div class="col-md-12" style="margin:0;">
                            <h3>Konfirmasi anda akan segera kami proses</h3>
                        </div>
                    <?php } ?>
                </div>
    
        </div>
    </div>
    </div>
    <!-- /.container -->

   <?php require("footer.php"); ?>