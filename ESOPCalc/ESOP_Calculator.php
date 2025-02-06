<?php
include './helpers.php';
include './header.php';
include './process_form.php';
?>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow" style="font-size: 0.75rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">
                <div class="card-header" style="background-color: darkorange;">
                    <h6 class="card-title text-white fw-bold">Dialectic Engineering</h6>
                </div>
                <div class="card-body p-2">
                    <form action="process_form.php" method="post">
                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="age" class="form-label me-2 fw-bold">Current Age:</label>
                            <select id="age" name="age" class="form-select form-select-sm" style="width: 20ch;">
                                <?php echo generateOptions(22, 70); ?>
                            </select>
                        </div>

                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="compensation" class="form-label me-2 fw-bold">Current Annual Compensation:</label>
                            <select id="compensation" name="compensation" class="form-select form-select-sm" style="width: 20ch;">
                                <?php echo generateOptions(50000, 200000, "$", 5000); ?>
                            </select>
                        </div>

                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="increase" class="form-label me-2 fw-bold">Expected Annual Compensation Increase:</label>
                            <select id="increase" name="increase" class="form-select form-select-sm" style="width: 20ch;">
                                <?php echo generatePercentageOptions(3, 3, 3); ?>
                            </select>
                        </div>

                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="retirement_age" class="form-label me-2 fw-bold">Desired Retirement Age:</label>
                            <select id="retirement_age" name="retirement_age" class="form-select form-select-sm" style="width: 20ch;">
                                <?php echo generateOptions(50, 70); ?>
                            </select>
                        </div>
                        <hr>
                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="match" class="form-label me-2 fw-bold">401K Salary Deferral Percentage:</label>
                            <select id="match" name="match" class="form-select form-select-sm" style="width: 20ch;">
                                <?php echo generatePercentageOptions(1, 20, 1); ?>
                            </select>
                        </div>

                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="esop_shares" class="form-label me-2 fw-bold">Current Shares Held in Your ESOP Account:</label>
                            <input type="number" id="esop_shares" name="esop_shares" class="form-control form-control-sm" style="width: 20ch;" placeholder="Shares">
                        </div>

                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="profit_sharing" class="form-label me-2 fw-bold">Dialectic Annual Contribution Profit Sharing:</label>
                            <select id="profit_sharing" name="profit_sharing" class="form-select form-select-sm" style="width: 20ch;">
                                <?php echo generatePercentageOptions(3, 6, 3); ?>
                            </select>
                        </div>

                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label for="non_esop_growth" class="form-label me-2 fw-bold">Growth - Non ESOP Investments (401k):</label>
                            <select id="non_esop_growth" name="non_esop_growth" class="form-select form-select-sm" style="width: 20ch;">
                                <?php echo generatePercentageOptions(3, 15, 3); ?>
                            </select>
                        </div>

                        <hr>

                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <label class="form-label me-2 fw-bold">Dialectic Current Share Price:</label>
                            <span class="fw-bold text-primary" style="font-size: 1.2rem;">$125.00</span>
                        </div>

                        <button type="button" id="submitForm" class="btn btn-orange btn-sm w-100" style="background-color: darkorange; color: white;">Submit</button>
                        <script>
                            $(document).ready(function () {
                                $('#submitForm').on('click', function () {
                                    // Gather form data
                                    const formData = {
                                        age: $('#age').val(),
                                        compensation: $('#compensation').val(),
                                        increase: $('#increase').val(),
                                        retirement_age: $('#retirement_age').val(),
                                        match: $('#match').val(),
                                        esop_shares: $('#esop_shares').val(),
                                        profit_sharing: $('#profit_sharing').val(),
                                        non_esop_growth: $('#non_esop_growth').val(),
                                    };

                                    // Send data to the server via AJAX
                                    $.ajax({
                                        url: 'process_form.php', // The PHP file to handle the request
                                        type: 'POST',
                                        data: formData,
                                        success: function (response) {
                                            // Parse the response and update the lower-left card
                                            const data = JSON.parse(response);

                                            $('#lower-age').text(data.age);
                                            $('#lower-compensation').text(data.compensation);
                                            $('#lower-increase').text(data.increase + '%');
                                            $('#lower-retirement-age').text(data.retirement_age);
                                            $('#lower-match').text(data.match + '%');
                                            $('#lower-esop-shares').text(data.esop_shares);
                                            $('#lower-profit-sharing').text(data.profit_sharing + '%');
                                            $('#lower-non-esop-growth').text(data.non_esop_growth + '%');
                                        },
                                        error: function (xhr, status, error) {
                                            console.error('Error:', error);
                                        },
                                    });
                                });
                            });
                        </script>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow" style="font-size: 0.75rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); height: 100%;">
                <div class="card-header" style="background-color: darkorange;">
                    <h6 class="card-title text-white fw-bold">Salary & Benefit Calculator</h6>
                </div>
                <div class="card-body p-2 d-flex flex-column align-items-center" style="position: relative; height: calc(100% - 70px);">
                    <div class="d-flex justify-content-center mb-3 w-100">
<!--                        <button class="btn btn-orange btn-lg mb-5" style="background-color: darkorange; color: white;">Button 1</button>-->
<!--                        <button class="btn btn-orange btn-lg mb-5" style="background-color: darkorange; color: white;">Button 2</button>-->
                    </div>
                    <div class="mb-3 text-center">
                        <label class="form-label fw-bold">Estimated Balance at Retirement:</label>
                        <div class="fw-bold text-success" style="font-size: 1.2rem;">$0.00</div>
                    </div>
                    <div class="mb-3 text-center">
                        <label class="form-label fw-bold">Total Dialectic Contributions:</label>
                        <div class="fw-bold text-success" style="font-size: 1.2rem;">$0.00</div>
                    </div>
                    <hr style="position: absolute; bottom: 40%; left: 0; width: 100%; margin-bottom: 20px;">
                    <div class="mt-auto w-100">
                        <canvas id="esopChart" style="max-height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card shadow" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); height: auto;">
                    <div class="card-body d-flex flex-column" style="height: auto;">
                        <!-- Grid Section -->
                        <div style="width: 100%; padding: 10px;">
                            <table id="benefitsGrid" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Age</th>
                                    <th>Salary</th>
                                    <th>ESOP Benefits</th>
                                    <th>Non ESOP Benefits (401k)</th>
                                    <th>Benefit Value ESOP (Cumulative)</th>
                                    <th>Benefit Value Non-ESOP (Cumulative)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <script>
                                    $(document).ready(function () {
                                        // Sample Data (10 Rows)
                                        const gridData = [
                                            { age: 25, salary: 60000, esopBenefits: 5000, nonEsopBenefits: 3000, esopCumulative: 5000, nonEsopCumulative: 3000 },
                                            { age: 26, salary: 62000, esopBenefits: 5500, nonEsopBenefits: 3200, esopCumulative: 10500, nonEsopCumulative: 6200 },
                                            { age: 27, salary: 64000, esopBenefits: 6000, nonEsopBenefits: 3400, esopCumulative: 16500, nonEsopCumulative: 9600 },
                                            { age: 28, salary: 66000, esopBenefits: 6500, nonEsopBenefits: 3600, esopCumulative: 23000, nonEsopCumulative: 13200 },
                                            { age: 29, salary: 68000, esopBenefits: 7000, nonEsopBenefits: 3800, esopCumulative: 30000, nonEsopCumulative: 17000 },
                                            { age: 30, salary: 70000, esopBenefits: 7500, nonEsopBenefits: 4000, esopCumulative: 37500, nonEsopCumulative: 21000 },
                                            { age: 31, salary: 72000, esopBenefits: 8000, nonEsopBenefits: 4200, esopCumulative: 45500, nonEsopCumulative: 25200 },
                                            { age: 32, salary: 74000, esopBenefits: 8500, nonEsopBenefits: 4400, esopCumulative: 54000, nonEsopCumulative: 29600 },
                                            { age: 33, salary: 76000, esopBenefits: 9000, nonEsopBenefits: 4600, esopCumulative: 63000, nonEsopCumulative: 34200 },
                                            { age: 34, salary: 78000, esopBenefits: 9500, nonEsopBenefits: 4800, esopCumulative: 72500, nonEsopCumulative: 39000 },
                                        ];

                                        // Initialize DataTable with Scroll and No Search
                                        $('#benefitsGrid').DataTable({
                                            data: gridData,
                                            columns: [
                                                { data: 'age', title: 'Age' },
                                                { data: 'salary', title: 'Salary', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                                                { data: 'esopBenefits', title: 'ESOP Benefits', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                                                { data: 'nonEsopBenefits', title: 'Non ESOP Benefits (401k)', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                                                { data: 'esopCumulative', title: 'Benefit Value ESOP (Cumulative)', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                                                { data: 'nonEsopCumulative', title: 'Benefit Value Non-ESOP (Cumulative)', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                                            ],
                                            paging: false, // Disable pagination
                                            searching: false, // Disable search functionality
                                            scrollY: '400px', // Set vertical scroll height
                                            scrollCollapse: true, // Allow the table to shrink if less data
                                            ordering: true,
                                            info: false,
                                            responsive: true,
                                        });
                                    });
                                </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                    <hr class="my-3">
                    <div id="chartContainer" style="width: 80%; margin: auto;">
                        <canvas id="benefitsChart" style="max-width: 100%; height: 300px;"></canvas>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Sample Data
                            const chartData = {
                                labels: ['Age 25', 'Age 26', 'Age 27', 'Age 28'],
                                datasets: [
                                    {
                                        type: 'bar',
                                        label: 'Salary',
                                        data: [60000, 62000, 64000, 66000],
                                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1,
                                    },
                                    {
                                        type: 'line',
                                        label: 'Benefit Value ESOP (Cumulative)',
                                        data: [5000, 10500, 16500, 23000],
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        fill: false,
                                        tension: 0.4,
                                    },
                                    {
                                        type: 'line',
                                        label: 'Benefit Value Non-ESOP (Cumulative)',
                                        data: [3000, 6200, 9600, 13200],
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        fill: false,
                                        tension: 0.4,
                                    },
                                ],
                            };

                            // Chart Configuration
                            const config = {
                                type: 'bar',
                                data: chartData,
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                        },
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Age',
                                            },
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Value ($)',
                                            },
                                            beginAtZero: true,
                                        },
                                    },
                                },
                            };

                            // Initialize Chart
                            const ctx = document.getElementById('benefitsChart').getContext('2d');
                            new Chart(ctx, config);
                        });
                    </script>

                </div>
            </div>

    <script>
    const ctx = document.getElementById('esopChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['2015', '2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [{
                label: 'ESOP Stock Price',
                data: [0.87, 0.90, 2.97, 8.51, 12.06, 28.44, 62.91],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>

