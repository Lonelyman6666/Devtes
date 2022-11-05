<!doctype html>
<html lang="en">
  <head>
    <title>Google Bar Chart | LaravelCode</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
  <body>
    <div class="container-fluid p-5">
      <form method="POST" action="/barchart">
        @csrf
        <div class="form-group">
          <select class="form-select" aria-label="Default select example" name="area">
          <option value="">Select Area</option>
            @foreach ($areas as $ars)
            <option value="{{$ars->area_id}}">{{$ars->area_name}}</option>
            @endforeach
          </select>
          <input type="date" class="" name="dateFrom" placeholder="Select dateFrom">
          <input type="date" class="" name="dateTo" placeholder="Select dateTo">
          <input type="submit" value="View">
        </div>
      </form>
    <div id="barchart_material" style="width: 100%; height: 500px;"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Area','Nilai'],

            @php
              use App\Report_product;
              foreach($areas as $area) {
                  $compliance = Report_product::join('store','report_product.store_id','=','store.store_id')
                              ->where('store.area_id',$area->area_id)->sum('compliance');
                  $row = Report_product::join('store','report_product.store_id','=','store.store_id')
                              ->where('store.area_id',$area->area_id)->COUNT()->get();
                  $data = $row->count();
                  $persen = 100;
                  $nilai = ($compliance/$data*$persen);

                  echo "['".$area->area_name."', ".$nilai."],";
              }
            @endphp
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div class="container-fluid">
      <table class="table table-dark">
        <tr>
          <th>Brand</th>
          @foreach ($areas as $a)
          <th>{{$a->area_name}}</th>
          @endforeach
        </tr>
        @foreach ($brands as $brand)
        <tr>
          <td>{{$brand->brand_name}}</td>
          @php
          foreach($areas as $a) {
            $complianceb = Report_product::join('store','report_product.store_id','=','store.store_id')
                        ->join('product','report_product.product_id','=','product.product_id')
                        ->where('brand_id',$brand->brand_id)
                        ->where('store.area_id',$a->area_id)->sum('compliance');
            $rowb = Report_product::join('store','report_product.store_id','=','store.store_id')
                        ->join('product','report_product.product_id','=','product.product_id')
                        ->where('store.area_id',$a->area_id)->COUNT()->get();
            $datab = $row->count();
            $persenb = 100;
            $nilaib = ($complianceb/$datab*$persenb);
          @endphp
          <td>{{$nilaib}}%</td>
          @php
          }
          @endphp
        </tr>
        @endforeach
      </table>
    </div>
</body>
</html>