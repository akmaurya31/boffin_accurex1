<?php include('header.php');?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style type="text/css">
	.logo{
		width: 100%;
	}
	nav#uk_header {
	    /* border-bottom: 1px solid #ccc; */
	    box-shadow: 0px 0px 5px 0px #ccc;
	    background: #fff;
	}
	.navbar>.container-fluid{
		display: block;
	}

	.nav-link{
		font-weight: 500;
	    color: #14264d;
	    font-family: system-ui;
	    font-size: 16px;
	}
	li.nav-item {
	    padding: 0px 15px;
	}
	.user {
	    border-left: 2px solid #182a50;
	    padding-left: 15px;
	    color: #14264d;
	    font-weight: 500;
	}
	.page-content{
		margin-top: 100px;
	}
	.section-header {
      background-color: #14264d;
      color: white;
      padding: 10px 20px;
      font-weight: bold;
    }
    .box {
      background-color: white;
      padding: 15px;
      border-radius: 4px;
      margin-bottom: 20px;
    }
    .breadcrumb {
      background-color: transparent;
      padding-left: 0;
    }
    body{
    	background: #0002390d;
    }
    .dashboard-tab-wrapper {
	  position: relative;
	  margin-bottom: 15px;
	}

	.dashboard-tab {
	  background-color: #14264d;
	  color: white;
	  font-weight: bold;
	  padding: 10px 25px;
	  display: inline-block;
	  border-top-left-radius:10px;
	  border-top-right-radius: 10px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	}

	.dashboard-line {
	  height: 2px;
	  background-color: #14264d;
	  width: 100%;
	  margin-top: -2px;
	}
	.breadcrumb-item a{
		color: #14264d;
	}

	.navbar{
		padding: 1rem 1rem;
	}
	div#jobChart {
        background: #fff;
        padding: 20px 0px;
    }
    
    .graphHeading{
        font-size: 18px;
        margin-bottom:0px;
    }
</style>
<?php include('navigation.php');?>
<div class="page-content">
  <!-- Breadcrumb -->
  </div>

   <!-- Dashboard Header -->
    <div class="container">
	<div class="container">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>
    </div>
	    <div class="dashboard-tab-wrapper mb-3">
		  <div class="dashboard-tab">DASHBOARD</div>
		  <div class="dashboard-line"></div>
	    </div>
		
	    <div class="row mt-3">
	    <!-- Completed Jobs -->
	    	<div class="col-md-8">
	      <div class="section-header">Today's Completed Jobs (<span id="countCJ">0</span>)</div>
	      <div class="box">
	        <div class="form-row mb-3">
	          <div class="col">
				<input type="text" class="form-control" id="searchJobCode" placeholder="Job Code">
	          </div>
	          <div class="col">
			   <input type="text" class="form-control" id="searchJobName" placeholder="Job Name">
	          </div>
	        </div>
	        <table class="table table-bordered table-sm table-striped table-hover table-bordered">
	          <thead>
	            <tr>
	              <th>Job Code</th>
	              <th>Job Name</th>
	            </tr>
	          </thead>
			  <tbody id="jobListBody">
	            
	          </tbody>
	        </table>
	      </div>
		      <nav><ul id="pagination" class="pagination"></ul></nav>
	    	</div>
		
	     <div class="col-md-4">
	      <div class="section-header"> Job Status </div>
	      <div id="pieChart"  class="box text-center">
	        <!-- <canvas id="jobStatusChart"></canvas> -->
	      </div>
	   
		  </div>

</div>


    <div class="container py-4">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #14264d; color: white;">
            <h3 class="graphHeading">Monthly Job Summary  </h3> 
            <div>
                <label for="year">Year</label>
                <select id="yearFilter" onchange="loadChart(this.value)">
                </select>
            </div>
        </div>  
        <div id="jobChart"></div>
    </div>

    <div class="container py-4">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #14264d; color: white;">
            <h3 class="graphHeading">Job Turnaround Time</h3>
            <div>
              <label for="year">Year</label>
              <select id="yearFilter_jtt" >
              </select>
            </div>  
        </div>

        <div id="jtt_chart" style="padding: 10px;background: #fff;"></div>
    </div>  
  <script>
   let jtt_chart;

  function fetchChartData(selectedYear) {
    $.ajax({
      url: '<?php echo base_url(); ?>clients/get_job_turnaround_data/' + selectedYear,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        const assignmentTypes = [...new Set(data.map(item => item.assignment_type))];

        const seriesData = assignmentTypes.map(type => {
          const monthly = Array(12).fill(null); // Jan to Dec
          data.forEach(row => {
            if (row.assignment_type === type) {
              monthly[row.month - 1] = parseFloat(row.avg_days);
            }
          });
          return { name: type, data: monthly };
        });

        if (jtt_chart) {
          jtt_chart.updateSeries(seriesData);
        } else {
          const options = {
            chart: { type: 'bar', height: 350, toolbar: { show: false } },
            plotOptions: {
              bar: { horizontal: false, columnWidth: '55%', endingShape: 'flat' }
            },
            dataLabels: { enabled: false },
            stroke: { show: true, width: 1, colors: ['transparent'] },
            xaxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                          'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yaxis: {
              title: { text: 'Days' },
              min: 0,
              max: 30
            },
            fill: { opacity: 1 },
            tooltip: {
              y: {
                formatter: val => (val ? val + " days" : "0 days")
              }
            },
            legend: { position: 'bottom' },
            colors: ['#81d4fa', '#f8bbd0', '#ffe0b2'],  // Apply custom colors here
            series: seriesData
          };

          jtt_chart = new ApexCharts(document.querySelector("#jtt_chart"), options);
          jtt_chart.render();
        }
      }
    });
  }

  $("#yearFilter_jtt").on("change", function () {
    const selectedYear = $(this).val() || new Date().getFullYear(); // default to current year
    fetchChartData(selectedYear);
  });

  // Initial load
  const currentYear_jtt1 = new Date().getFullYear();
  fetchChartData(currentYear_jtt1);

  </script>



    <div class="container py-4">

    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #14264d; color: white;">
    <h3>Margin</h3>
    <div>
      <label for="year">Year</label>
      <select id="year">
        <option value="2025" selected>2025</option>
        <option value="2024">2024</option>
        <option value="2023">2023</option>
        <option value="2022">2022</option>
      </select>
    </div>
  </div>

  <div id="chart" style="padding: 10px;background: #fff;"></div>
  </div>

  <script>
    const Margin_options = {
      chart: {
        type: 'bar',
        height: 350,
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                     'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
      },
      yaxis: {
        title: {
          text: 'Margin %'
        },
        max: 80
      },
      fill: {
        opacity: 1,
        colors: ['#81d4fa']
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "%";
          }
        }
      },
      series: [{
        name: 'Margin',
        data: [67, 62, 64, 66, 71, 69, 72, 73, 68, 70, 67, 65]
      }]
    };

    const Marginchart = new ApexCharts(document.querySelector("#chart"), Margin_options);
    Marginchart.render();
  </script>




<?php include('footer.php');?>


	<script>

let currentPage = 1;
let searchTerm = '';

function loadJobs(page = 1, search = '') {
    $.ajax({
        url: "<?= base_url('Clients/fetch_paginated_jobs') ?>",
        method: 'GET',
        data: { page: page, limit: 20, search: search },
        dataType: 'json',
        success: function (res) {
            let html = '';
            res.jobs.forEach(job => {
                html += `<tr><td>${job.job_code}</td><td>${job.job_name}</td></tr>`;
            });
            $('#jobTable tbody').html(html);

            const totalPages = Math.ceil(res.total / 20);
            renderPagination(totalPages, page);
        }
    });
}
 

function renderPagination(totalPages, currentPage) {
    let html = '';
    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#">${i}</a>
                 </li>`;
    }
    $('#pagination').html(html);
}

$(document).on('click', '#pagination .page-link', function (e) {
    e.preventDefault();
    currentPage = parseInt($(this).text());
    loadJobs(currentPage, searchTerm);
});

$('#searchInput').on('keyup', function () {
    searchTerm = $(this).val();
    loadJobs(1, searchTerm);
});

$(document).ready(function () {
    loadJobs();
});


	</script>


<script>
// let currentPage = 1;

function loadCompletedJobs(page = 1) {
    const jobCode = $('input[placeholder="Job Code"]').val();
    const jobName = $('input[placeholder="Job Name"]').val();

    $.ajax({
        url: "<?= base_url('Clients/fetch_completed_jobs_today') ?>",
        type: 'GET',
        data: {
            page: page,
            limit: 20,
            job_code: jobCode,
            job_name: jobName
        },
        dataType: 'json',
        success: function(response) {
            let rows = '';
            response.jobs.forEach(job => {
                rows += `<tr><td>${job.jobcode}</td><td>${job.job_name}</td></tr>`;
            });
            $('table tbody').html(rows);
			$('#countCJ').html(response.total)

            let totalPages = Math.ceil(response.total / 20);
            renderPagination(totalPages, page);
        }
    });
}

function renderPagination(totalPages, currentPage) {
    let html = '';
    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                   <a class="page-link" href="#">${i}</a>
                 </li>`;
    }
    $('#pagination').html(html);
}

$(document).on('click', '#pagination .page-link', function(e) {
    e.preventDefault();
    currentPage = parseInt($(this).text());
    loadCompletedJobs(currentPage);
});

$('input[placeholder="Job Code"], input[placeholder="Job Name"]').on('keyup', function() {
    loadCompletedJobs(1);
});

$(document).ready(function() {
    loadCompletedJobs();
});
</script>



<script>
  // Search on typing (with delay)
  let searchTimer;
  $('#searchJobCode, #searchJobName').on('keyup', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
      loadJobs(1); // Search always loads from page 1
    }, 500);
  });

  // Load first page on ready
  $(document).ready(function() {
    loadJobs(1);
  });
</script>

 

<script>
    // Data values
	 
	var dataValues = [<?= $chart['on_hold'] ?>, <?= $chart['completed'] ?>, <?= $chart['current'] ?>];
	var fruitNames = ['On Hold', 'Completed', 'In Progress'];

    // Labels with value appended: Apple (44), etc.
    var labelsWithValues = fruitNames.map((name, index) => `${name} (${dataValues[index]})`);

    var options = {
      chart: {
        type: 'pie',
        height: 350
      },
      series: dataValues,
      labels: labelsWithValues,
      legend: {
        position: 'bottom'
      },
      colors: ['#f65d1f', '#28a745', '#14264d']
    };

    var chart = new ApexCharts(document.querySelector("#pieChart"), options);
    chart.render();
  </script>


	<script>


const yearSelect_jtt = document.getElementById('yearFilter_jtt');
const currentYear_jtt = new Date().getFullYear();

for (let y = currentYear_jtt; y >= 2023; y--) {
    let opt = document.createElement('option');
    opt.value = y;
    opt.innerText = y;
    yearSelect_jtt.appendChild(opt);
}

 

// Dynamically populate year dropdown
const yearSelect = document.getElementById('yearFilter');
const currentYear = new Date().getFullYear();

for (let y = currentYear; y >= 2023; y--) {
    const opt = document.createElement('option');
    opt.value = y;
    opt.innerText = y;
    yearSelect.appendChild(opt);
}

let chart1;

function loadChart(year) {
    fetch(`<?= base_url('Clients/FetchBarCharti/') ?>${year}`)
        .then(res => res.json())
        .then(data => {
            const series = [
                {
                    name: 'Bookkeeping',
                    data: data.bookkeeping ? Object.values(data.bookkeeping) : []
                },
                {
                    name: 'Year End Accounts',
                    data: data.year_end_account ? Object.values(data.year_end_account) : []
                },
                {
                    name: 'Personal Tax Return',
                    data: data.personal_tax_return ? Object.values(data.personal_tax_return) : []
                },
                {
                    name: 'Other',
                    data: data.other ? Object.values(data.other) : []
                }
            ];

            const options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: series,
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '75%',
                        borderRadius: 1
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetY: -10,
                    style: {
                        fontSize: '12px',
                        colors: ['#000']
                    }
                },
                colors: ['#f65d1f', '#28a745', '#edb743', '#72deed'],
                legend: {
                    position: 'top'
                },
                title: {
                    text: `Monthly Job Summary (${year})`,
                    align: 'center'
                }
            };

            if (chart1) {
                chart1.updateOptions(options);
            } else {
                chart1 = new ApexCharts(document.querySelector("#jobChart"), options);
                chart1.render();
            }
        });
}

// Load chart for the current year on page load
document.addEventListener('DOMContentLoaded', () => {
    loadChart(currentYear);
});
</script>