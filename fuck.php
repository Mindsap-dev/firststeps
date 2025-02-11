<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dialectic ESOP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JQWidgets CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@13.2.0/jqwidgets/styles/jqx.base.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JQWidgets JS -->
    <script src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@13.2.0/jqwidgets/jqx-all.js"></script>
    <style>
        .multi-line-header {
            white-space: normal !important;
            text-align: center;
            line-height: 1.2;
            display: block;
            word-wrap: break-word;
        }
    </style>

</head><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dialectic ESOP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JQWidgets CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@13.2.0/jqwidgets/styles/jqx.base.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JQWidgets JS -->
    <script src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@13.2.0/jqwidgets/jqx-all.js"></script>

    <style>
        .multi-line-header {
            white-space: normal !important;
            text-align: center;
            line-height: 1.2;
            display: block;
            word-wrap: break-word;
        }
    </style>

</head>
<body>
<div class="container my-5">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fs-6">Dialectic Engineering</h5>
                    <!-- Top Half -->
                    <div class="row g-2">
                        <div class="col-6">
                            <label for="currentAge" class="form-label fs-7">Current Age</label>
                            <select id="currentAge" class="form-select form-select-sm">
                                <?php for ($i = 20; $i <= 70; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="retirementAge" class="form-label fs-7">Expected Retirement Age</label>
                            <select id="retirementAge" class="form-select form-select-sm">
                                <?php for ($i = 50; $i <= 70; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="currentSalary" class="form-label fs-7">Current Salary</label>
                            <select id="currentSalary" class="form-select form-select-sm">
                                <?php for ($i = 50000; $i <= 200000; $i += 5000): ?>
                                    <option value="<?= $i ?>"><?= number_format($i) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Separator Line -->
                    <hr>
                    <!-- Bottom Half -->
                    <div class="row g-2">
                        <div class="col-6">
                            <label for="percent401k" class="form-label fs-7">401k Contribution</label>
                            <select id="percent401k" class="form-select form-select-sm">
                                <?php for ($i = 1; $i <= 20; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?>%</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="growth401k" class="form-label fs-7">401k % Growth (Projected)</label>
                            <select id="growth401k" class="form-select form-select-sm">
                                <?php for ($i = 4; $i <= 15; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?>%</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="esopShares" class="form-label fs-7"># of Current ESOP Shares</label>
                            <input type="number" id="esopShares" class="form-control form-control-sm" placeholder="Enter number of shares">
                        </div>
                        <div class="col-6">
                            <label for="esopStockPrice" class="form-label fs-7">Current Dialectic ESOP Stock Price</label>
                            <input type="text" id="esopStockPrice" class="form-control form-control-sm" value="64.25" readonly>
                        </div>
                        <div class="col-12">
                            <button id="calculateButton" class="btn btn-primary btn-sm w-100">Calculate</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Card 2 Placeholder -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Top Half -->
                    <div class="row g-2 justify-content-center">
                        <div class="col-12">
                            <label class="form-label fs-7 d-block">Estimated Balance at Retirement</label>
                            <div id="retirementBalance" class="placeholder bg-light border rounded p-1 text-center" style="font-size: 0.9rem; width: 80%; margin: 0 auto;">
                                -- Not Calculated --
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fs-7 d-block">Total Dialectic Contributions</label>
                            <div id="totalContributions" class="placeholder bg-light border rounded p-1 text-center" style="font-size: 0.9rem; width: 80%; margin: 0 auto;">
                                -- Not Calculated --
                            </div>
                        </div>
                    </div>
                    <!-- Separator Line -->
                    <hr>
                    <!-- Bottom Half -->
                    <div class="row g-2">
                        <div class="col-12">
                            <div class="chart-container" style="margin: 0 auto; width: 90%;">
                                <canvas id="stockPriceChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <!-- Full Width Card with jqxGrid -->
        <div class="col-12">
            <div class="card bg-light border">
                <div class="card-body text-center p-2">
                    <p id="textDisplay" class="mb-0" style="font-size: 0.9rem;">This is a hypothetical model to illustrate the potential growth of this type of investment. Salary increases, profit sharing and match contributions, and growth assumptions are all for illustrative purposes only. This model does not imply or guarantee certain salary increases, retirement plan contributions, return on ESOP stock, or continuance of the plan. Investment returns can fluctuate significantly from year to year and can include loss years and loss of principal contributions. Past performance is not an indicator of future returns. </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Grid</h5>
                    <div id="jqxgrid"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <!-- Full Width Card with Chart -->
    <div class="row mt-4">
        <!-- Full Width Card with Chart -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Graph</h5>
                    <div class="chart-container" style="margin: 0 auto; width: 90%;">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

</script>