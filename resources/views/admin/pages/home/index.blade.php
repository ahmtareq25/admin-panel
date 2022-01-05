@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h4 class="title">Total Post <small>(1200)</small></h4>
                            <p class="category">January-May, 2017</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control datepicker" placeholder="Select Month">
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div id="chartActivity" class="ct-chart"></div>

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Income
                            <i class="fa fa-circle text-danger"></i> Expense
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-check"></i> Last Updated on 31 May, 2017
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">All Categories</h4>
                    <p class="category">Based on categories</p>
                </div>
                <div class="content">
                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-primary"></i> Salary
                            <i class="fa fa-circle text-danger"></i> Office Rent
                            <i class="fa fa-circle text-warning"></i> Marketing
                            <i class="fa fa-circle text-info"></i> Others
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-check"></i> Last Updated on 31 May, 2017
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h4 class="title">Total Number of Visitors</h4>
                            <p class="category">January-May, 2017</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control datepicker" placeholder="Select Month">
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div id="chartPreferences1" class="ct-chart ct-perfect-fourth"></div>

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Customer 1
                            <i class="fa fa-circle text-danger"></i> Customer 2
                            <i class="fa fa-circle text-warning"></i> Customer 3
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-check"></i> Last Updated on 31 May, 2017
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection