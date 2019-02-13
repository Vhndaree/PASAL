<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="logo.png">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PASAL') }}</title>

        <!--javaScript -->
        <script src="{{asset('js/app.js')}}"></script>
        <script
    	  src="https://code.jquery.com/jquery-3.3.1.js"
    	  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    	  crossorigin="anonymous">
        </script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{asset('css/custom/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
     
    </head>
    <body> 
        <div class=" ml-sm-auto col-lg-9 px-2">
        <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Stock calculator') }}
                    </div> 
                    <div class="card-body">                        
                        <table>
                            <tr>
                                <td><label for="areq">{{ __('Annual requirement') }}</label></td>
                                <td><input type="text"  id="areq" placeholder="Annual requirement" required></td>
                            </tr>
                        
                            <tr>
                                <td><label for="sstk">{{ __('saftey stock') }}</label></td>
                                <td><input type="text"  id="sstk" placeholder="Saftey Stock" required></td>
                            </tr>
                            
                            <tr>
                                <td><label for="ocost">{{ __('Ordering cost') }}</label></td>
                                <td><input type="text"  id="ocost" placeholder="Ordering cost" required></td>
                            </tr>

                            <tr>
                                <td><label for="pprice">{{ __('Purchase price') }}</label></td>
                                <td><input type="text"  id="pprice" placeholder="Purchase price" required></td>
                            </tr>

                            <tr>
                                <td><label for="ccost">{{ __('Carrying cost') }}</label></td>
                                <td><input type="text" id="ccost" placeholder="Carrying cost" required></td>
                            </tr>

                            <tr>
                                <td><label for="ltime">{{ __('Lead time') }}</label></td>
                                <td><input type="text" id="ltime" placeholder="Lead time in days" required></td>
                            </tr>
                        </table>
                                                                   
                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button onclick="calculateStock()" class="btn btn-primary" >
                                    Calculate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card Body">
                        <table>
                            <tr>
                                <td id="ar">
                                </td>
                                <td style="padding-left:10px;color:#649446;" id="arv">
                                </td>
                            </tr>
                            <tr>
                                <td id="os">
                                </td>
                                <td style="padding-left:10px;color:#649446;" id="osv">
                                </td>
                            </tr>
                            <tr>
                                <td id="ai">
                                </td>
                                <td style="padding-left:10px;color:#649446;" id="aiv">
                                </td>
                            </tr>
                            <tr>
                                <td id="aii">
                                </td>
                                <td style="padding-left:10px;color:#649446;" id="aiiv">
                                </td>
                            </tr>
                            <tr>
                                <td id="nor">
                                </td>
                                <td style="padding-left:10px;color:#649446;" id="norv">
                                </td>
                            </tr>
                            <tr>
                                <td id="">
                                </td>
                                <td style="padding-left:10px;color:#649446;" id="">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function calculateStock(){
                //inputs
                var areq=Number(document.getElementById("areq").value);
                var sstk=Number(document.getElementById("sstk").value);
                var ocost=Number(document.getElementById("ocost").value);
                var pprice=Number(document.getElementById("pprice").value);
                var ccost=(Number(document.getElementById("ccost").value)/100)*pprice;
                var ltime=Number(document.getElementById("ltime").value);

                //results
                var eoq=Math.ceil(Math.pow((2*areq*ocost/ccost),0.5));
                var os=Math.ceil(eoq+sstk);
                var ai=Math.ceil(eoq/2+sstk);
                var aii=Math.ceil(ai*pprice);
                var nor=Math.ceil(areq/eoq);

                //Display to the users
                document.getElementById("ar").innerHTML="EOQ";
                document.getElementById("arv").innerHTML=eoq+" units.";

                document.getElementById("os").innerHTML="Order size at outset";
                document.getElementById("osv").innerHTML=os+" units.";

                document.getElementById("ai").innerHTML="Average inventory";
                document.getElementById("aiv").innerHTML=ai+" units.";

                document.getElementById("aii").innerHTML="Average investment in inventory";
                document.getElementById("aiiv").innerHTML="Rs. "+aii;


                document.getElementById("nor").innerHTML="NO.of order";
                document.getElementById("norv").innerHTML=nor+" times";

            }
        </script>
        <script>
            document.write<?php echo"hello";?>);
        </script>
    </body>
</html>
