@extends('layout.layout')
@section("content")
    <div class="" id="my-gallery-container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding">
                <a href="">
                    <div class="item" data-order="0">
                        <p>item 31</p>
                    </div>
                </a>
                <div class="item h200" data-order="4">
                    <p>item 27</p>
                </div>
                <div class="item" data-order="8">
                    <p>item 23</p>
                </div>
                <div class="item h200" data-order="12">
                    <p>item 19</p>
                </div>
                <div class="item h150" data-order="16">
                    <p>item 15</p>
                </div>
                <div class="item h150" data-order="20">
                    <p>item 11</p>
                </div>
                <div class="item h150" data-order="24">
                    <p>item 7</p>
                </div>
                <div class="item h150" data-order="28">
                    <p>item 3</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding">
                <div class="item h150" data-order="1">
                    <p>item 30</p>
                </div>
                <div class="item" data-order="5">
                    <p>item 26</p>
                </div>
                <div class="item h200" data-order="9">
                    <p>item 22</p>
                </div>
                <div class="item" data-order="13">
                    <p>item 18</p>
                </div>
                <div class="item h200" data-order="17">
                    <p>item 14</p>
                </div>
                <div class="item h200" data-order="21">
                    <p>item 10</p>
                </div>
                <div class="item h200" data-order="25">
                    <p>item 6</p>
                </div>
                <div class="item h250" data-order="29">
                    <p>item 2</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding">
                <div class="item" data-order="2">
                    <p>item 29</p>
                </div>
                <div class="item h100" data-order="6">
                    <p>item 25</p>
                </div>
                <div class="item h200" data-order="10">
                    <p>item 21</p>
                </div>
                <div class="item h100" data-order="14">
                    <p>item 17</p>
                </div>
                <div class="item" data-order="18">
                    <p>item 13</p>
                </div>
                <div class="item" data-order="22">
                    <p>item 9</p>
                </div>
                <div class="item" data-order="26">
                    <p>item 5</p>
                </div>
                <div class="item h200" data-order="30">
                    <p>item 1</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding">
                <div class="item h150" data-order="3">
                    <p>item 28</p>
                </div>
                <div class="item h150" data-order="7">
                    <p>item 24</p>
                </div>
                <div class="item h250" data-order="11">
                    <p>item 20</p>
                </div>
                <div class="item h150" data-order="15">
                    <p>item 16</p>
                </div>
                <div class="item h100" data-order="19">
                    <p>item 12</p>
                </div>
                <div class="item h100" data-order="23">
                    <p>item 8</p>
                </div>
                <div class="item h100" data-order="27">
                    <p>item 4</p>
                </div>
                <div class="item" data-order="31">
                    <p>item 0</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
    <script src="{{asset('js/mp.mansory.js')}}"></script>
    <script>
        $(function ($) {
            $("#my-gallery-container").mpmansory(
                {
                    childrenClass: 'item', // default is a div
                    columnClasses: 'padding', //add classes to items
                    breakpoints: {
                        lg: 3,
                        md: 4,
                        sm: 6,
                        xs: 12
                    },
                    distributeBy: {order: false, height: false, attr: 'data-order', attrOrder: 'asc'}, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
                    onload: function (items) {
                        //make somthing with items
                    }
                }
            );
        });
    </script>
@endsection
