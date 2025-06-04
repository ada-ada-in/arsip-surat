<?= $this->extend('layouth/user_layout') ?>
<?= $this->section('content') ?>

<div class="xs-pd-20-10 pd-ltr-20" style="position: relative; min-height: 100vh;">
    <!-- Background Image Container -->
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
             style="max-width: 60%; 
                    max-height: 60%;
                    opacity: 0.8;
                    object-fit: contain;">
    </div>
    
    <!-- Content Container -->
    <div style="position: relative; z-index: 1;">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Dashboard Overview</h2>
        </div>

        <div class="row pb-10">
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3" style="background-color: rgba(255,255,255,0.85);">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="countsurat">0</div>
                            <div class="font-14 text-secondary weight-500">
                                Arsip
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b" style="background-color: rgba(255,91,91,0.1);">
                                <span class="icon-copy bi bi-file-earmark-text" style="color: #ff5b5b;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3" style="background-color: rgba(255,255,255,0.85);">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="suratmasuk">0</div>
                            <div class="font-14 text-secondary weight-500">
                                Surat Masuk
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" style="background-color: rgba(66, 133, 244, 0.1);">
                                <i class="icon-copy bi bi-file-earmark-arrow-down" style="color: #4285f4;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3" style="background-color: rgba(255,255,255,0.85);">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="suratkeluar">0</div>
                            <div class="font-14 text-secondary weight-500">
                                Surat Keluar
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06" style="background-color: rgba(9, 204, 6, 0.1);">
                                <i class="icon-copy bi bi-file-earmark-arrow-up" style="color: #09cc06;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Consolidated AJAX function
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
                    console.error('Error fetching data:', error);
                    $(elementId).html('0');
                }
            });
        }

        // Fetch all data
        fetchData('/api/v1/surat/count/users', '#countsurat');
        fetchData('/api/v1/surat/countin/users', '#suratmasuk');
        fetchData('/api/v1/surat/countout/users', '#suratkeluar');
    });
</script>

<?= $this->endSection() ?>