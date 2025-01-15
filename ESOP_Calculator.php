<?php
// Generate options for dropdowns
function generateOptions($start, $end, $suffix = "", $step = 1) {
    $options = "";
    for ($i = $start; $i <= $end; $i += $step) {
        $value = $suffix ? number_format($i, 0, '.', ',') . $suffix : $i;
        $options .= "<option value=\"$i\">$value</option>";
    }
    return $options;
}

// Generate percentage options
function generatePercentageOptions($start, $end, $default) {
    $options = "";
    for ($i = $start; $i <= $end; $i++) {
        $selected = ($i == $default) ? " selected" : "";
        $options .= "<option value=\"$i\"$selected>{$i}%</option>";
    }
    return $options;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dialectic Engineering</title>
</head>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow" style="font-size: 0.75rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">
                <div class="card-header" style="background-color: darkorange;">
                    <h3 class="card-title text-white fw-bold">Dialectic Engineering</h3>
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

                        <button type="submit" class="btn btn-orange btn-sm w-100" style="background-color: darkorange; color: white;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow" style="font-size: 0.75rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); height: 100%;">
                <div class="card-header" style="background-color: darkorange;">
                    <h3 class="card-title text-white fw-bold">Additional Actions</h3>
                </div>
                <div class="card-body p-2 d-flex flex-column align-items-center" style="position: relative; height: calc(100% - 70px);">
                    <div class="d-flex justify-content-center mb-3 w-100">
                        <button class="btn btn-primary btn-sm me-2">Button 1</button>
                        <button class="btn btn-secondary btn-sm">Button 2</button>
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
        <div class="col-12">
            <div class="card shadow" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">
                <div class="card-body d-flex flex-column" style="height: 400px;">
                    <div class="d-flex" style="flex: 1;">
                        <div class="border-end" style="flex: 0 0 35%; padding-right: 10px;">
                            <form>
                                <div class="mb-1">
                                    <label for="age" class="form-label fw-bold" style="font-size: 0.75rem;">Current Age:</label>
                                    <select id="age" name="age" class="form-select form-select-sm" style="width: 100%;">
                                        <?php echo generateOptions(22, 70); ?>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="compensation" class="form-label fw-bold" style="font-size: 0.75rem;">Annual Compensation:</label>
                                    <select id="compensation" name="compensation" class="form-select form-select-sm" style="width: 100%;">
                                        <?php echo generateOptions(50000, 200000, "$", 5000); ?>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="increase" class="form-label fw-bold" style="font-size: 0.75rem;">Compensation Increase:</label>
                                    <select id="increase" name="increase" class="form-select form-select-sm" style="width: 100%;">
                                        <?php echo generatePercentageOptions(3, 6, 3); ?>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="retirement_age" class="form-label fw-bold" style="font-size: 0.75rem;">Retirement Age:</label>
                                    <select id="retirement_age" name="retirement_age" class="form-select form-select-sm" style="width: 100%;">
                                        <?php echo generateOptions(50, 70); ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div style="flex: 1; padding-left: 10px;">
                            <p class="text-center fw-bold">Right Section (65%)</p>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="d-flex flex-grow-1">
                        <!-- Placeholder for grid -->
                        <p class="text-center w-100">Grid Section</p>
                    </div>
                </div>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
