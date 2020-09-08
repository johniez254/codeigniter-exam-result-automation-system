<div class="col-lg-12">
    <section class="box purple">
        <header class="panel_header">
            <h2 class="title pull-left">Manage Units</h2>
            <div class="actions panel_actions pull-right">
                <i class="box_toggle fa fa-chevron-down"></i>
            </div>
        </header>
        <div class="content-body">    
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Horizontal - start -->
                <div class="row">
                    <div class="col-md-12">

                        <ul class="nav nav-tabs primary">
                            <li class="active">
                                <a href="#home-1" data-toggle="tab">
                                    <i class="fa fa-newspaper-o"></i> My Units (<?php echo $countUnits;?>)
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content primary">
                            <div class="tab-pane fade in active" id="home-1">

                                <div>

                                    <div class="table-responsive">
                                       <?PHP if($countUnits!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/lecturer_units/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($lecturerId))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                    <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                    <?php }?>
                                    <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table " cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <?php /*?><th>Action</th><?php */?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                           <?php
                                           $i=1;
                                           foreach($unitsQuery as $row):
                                             $unit_id=$row['unit_id'];
                                             $u_name=$row['unit_name'];
                                             $u_code=$row['unit_code'];
                                             $posted=$row['posted_date'];

                                             ?>
                                             <tr>
                                                <td><?php echo $i++;?>.</td>
                                                <td><?php echo $u_code?></td>
                                                <td><?php echo $u_name?></td>

                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <!-- ********************************************** -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"><br></div>
        </div>
    </div>
</div>
</div>
</section>
</div>



