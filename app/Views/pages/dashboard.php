<?= $this->extend('layouth/admin_layout') ?>
<?= $this->section('content') ?>

<div class="xs-pd-20-10 pd-ltr-20" style="position: relative;">
    <!-- Background with opacity control -->
	<div style="position: absolute; 
				top: 0; 
				left: 0; 
				right: 0; 
				bottom: 0;
				display: flex;
				justify-content: center;
				align-items: center;
				z-index: 0;
				pointer-events: none;">
		<img src="/images/logo-bawaslu.png" 
			style="max-width: 80%; 
					max-height: 80%;
					opacity: 0.9;
					object-fit: contain;">
	</div>
    
    <!-- Content container -->
    <div style="position: relative; z-index: 1; opacity: 0.7">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Dashboard Overview</h2>
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3" style="background-color: rgba(255,255,255,0.9);">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="countuser">0</div>
                            <div class="font-14 text-secondary weight-500">
                                Users
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="icon-copy dw dw-user1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3" style="background-color: rgba(255,255,255,0.9);">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="countsurat">0</div>
                            <div class="font-14 text-secondary weight-500">
                                Arsip
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <span class="icon-copy bi bi-filetype-doc"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3" style="background-color: rgba(255,255,255,0.9);">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="suratmasuk">0</div>
                            <div class="font-14 text-secondary weight-500">
                                Surat Masuk
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy bi bi-file-earmark-arrow-down" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3" style="background-color: rgba(255,255,255,0.9);">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="suratkeluar">0</div>
                            <div class="font-14 text-secondary weight-500">Surat Keluar</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06">
                                <i class="icon-copy bi bi-file-earmark-arrow-up" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white pd-20 card-box mb-30" style="background-color: rgba(255,255,255,0.9);">
            <h4 class="h4 text-blue">Chart Surat</h4>
            <div id="chart2" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to handle AJAX calls
        function fetchData(url, elementId) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response && response.data !== undefined) {
                        $(elementId).html(response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        
        // Load all data
        fetchData('/api/v1/user/count', '#countuser');
        fetchData('/api/v1/surat/count', '#countsurat');
        fetchData('/api/v1/surat/countin', '#suratmasuk');
        fetchData('/api/v1/surat/countout', '#suratkeluar');
    });
</script>

<?= $this->endSection() ?>