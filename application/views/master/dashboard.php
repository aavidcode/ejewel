<div class="pageheader">
    <h2><i class="fa fa-home"></i> Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li> 
        </ol>
    </div>
</div>
<div class="contentpanel">   
    <div class="row">      
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-3">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Total Users</small>
                    <h1><a href="master/listAll/0" style="color:#ffffff"><?php echo $totalUserCount; ?></a></h1>
                  </div>
                </div><!-- row -->  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-3">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Pending Users</small>
                    <h1><?php if($totalActiveUserCount ==0) {echo $totalActiveUserCount;} else{echo '<a href="master/approval/0/0" style="color:#ffffff">'.$totalActiveUserCount.'</a>';} ?></h1>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
    </div>
</div> 