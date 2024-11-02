<?php 
include 'inc/Header.php';
?>
  
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <?php include 'inc/Navbar.php'; ?>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
       <?php 
	   include 'inc/Sidebar.php';
	   ?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Page Management</h3>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">
             
             <div class="col-sm-12">
                <div class="card">
				<div class="card-body">
                 <?php 
				 if(isset($_GET['id']))
				 {
					 $data = $service->query("select * from tbl_page where id=".$_GET['id']."")->fetch_assoc();
					 ?>

					 <form method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
								
								<div class="form-group mb-3">
                                    
                                        <label  id="basic-addon1">Enter Page Title</label>
                                   
                                  <input type="text" class="form-control" placeholder="Enter Page Title" name="ctitle" value="<?php echo $data['title'];?>" aria-label="Username" aria-describedby="basic-addon1">
								  <input type="hidden" name="type" value="edit_page"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                </div>
								
                                    
                                   <div class="form-group mb-3">
                                   
                                        <label  for="inputGroupSelect01">Select Page Status</label>
                                    
                                    <select class="form-control" name="cstatus" id="inputGroupSelect01" required>
                                        <option value="">Choose...</option>
                                        <option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
                                        <option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
                                       
                                    </select>
                                </div>
								
								
								<div class="form-group mb-3">
									<label for="cname">Page Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"><?php echo $data['description'];?></textarea>
								</div>
							
                                    <button type="submit" class="btn btn-primary">Edit Pages</button>
                                </form>
					 <?php 
				 }
				 else 
				 {
				 ?>
                  <form method="POST"  onsubmit="return postForm()">
								
								<div class="form-group mb-3">
                                    
                                        <label  id="basic-addon1">Enter Page Title</label>
                                    
                                  <input type="text" class="form-control" placeholder="Enter Page Title" name="ctitle" aria-label="Username" aria-describedby="basic-addon1">
								  <input type="hidden" name="type" value="add_page"/>
                                </div>
								
                                    
                                   <div class="form-group mb-3">
                                    
                                        <label  for="inputGroupSelect01">Select Page Status</label>
                                    
                                    <select class="form-control" name="cstatus" id="inputGroupSelect01" required>
                                        <option value="">Choose...</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Unpublish</option>
                                       
                                    </select>
                                </div>
								
								
								<div class="form-group mb-3">
									<label for="cname">Page Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"></textarea>
								</div>
							
                                    <button type="submit" class="btn btn-primary">Add Pages</button>
                                </form>
				 <?php } ?>
                </div>
              </div>
                
              </div>
              
              
              
              
              
              
              
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
       
      </div>
    </div>
    <!-- latest jquery-->
   <?php include 'inc/Footer.php';?>
    <!-- login js-->
    <!-- Plugin used-->
  </body>

</html>