@extends('layouts.includes.app')
@section('content')

    <div class="page-content mt-5 mb-5">
        <div class="container">
        <!-- Page title -->
        <div class="card">
            <div class="text-center">
                <h4>История заказов</h4>
            </div>
            <div class="card-body " style="overflow-x:auto;">
                <table class="shop-table account-orders-table mb-6 " >
                    <thead >
                    <tr >
                        <th scope="col" class="text-center" colspan="5">Номенклатура</th>
                        <th scope="col" class="text-center" colspan="2">Финансовая компания</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Наименование</th>
                        <th scope="col" class="text-center">Продавец</th>
                        <th scope="col" class="text-center" style="width:70px;">Количество</th>
                        <th scope="col" class="text-center">Сумма</th>
                        <th scope="col" class="text-center">Название</th>
                        <th scope="col" class="text-center">Статус</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($orders)
                        @php $count = 0; @endphp
                        @foreach($orders as  $order)
                            @if($order->productOrders()->exists())
                            @foreach($order->productOrders as $id => $product )
                            <tr>
                            <td class=" text-center">{{++$count}}</td>
                            <td class="text-center">{{$product->product->name}}</td>
                            <td class="text-center">{{$product->shop->name}}</td>
                            <td class="text-center">{{$product->amount}}</td>
                            <td class="text-center">{{$order->total}}</td>
                            <td class="text-center">{{$order->creditProductOrders->creditProduct->company->name}}<br>
                                <a href="#"  class="modal">Посмотреть условия</a>
                                <input class="credit_product_id" type="hidden" value="{{$order->creditProductOrders->creditProduct->id}}"/>
                            </td>
                            <td class="text-center">{{\App\Enum\FinStatusOrder::toTitlesArray()[$order->creditProductOrders->status_id]}}</td>
                        </tr>
                            @endforeach
                            @endif
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <div id = "mySizeChartModal" class="ebcf_modal">
        <div class="ebcf_modal-content "style="overflow-x:auto;">
            <span class="ebcf_close">&times;</span>
            <table border="1">
                <thead border="1"><tr>
                    <th class="text-center" style="width: 10px;vertical-align: middle">#</th>
                    <th style="vertical-align: middle">Название</th>
                    <th class="text-center" style="vertical-align: middle">Cтавка</th>
                    <th class="text-center" style="vertical-align: middle">Выдача</th>
                    <th class="text-center" style="vertical-align: middle">Обналичивание</th>
                </tr>
                </thead>
                <tbody border="1" id="document_body">

                </tbody>
            </table>
        </div>

    </div>

@endsection
@push('scripts')
    <script>
        // Get the modal
        let ebModal = document.getElementById('mySizeChartModal');
        // Get the button that opens the modal
        let ebBtn = document.getElementsByClassName("modal");
        // Get the <span> element that closes the modal
        let ebSpan = document.getElementsByClassName("ebcf_close")[0];
        // When the user clicks the button, open the modal
        let credit_product = document.getElementsByClassName('credit_product_id');
        let document_body = document.getElementById('document_body');
        for(let i=0; i < ebBtn.length;i++){
            ebBtn[i].addEventListener('click', async function () {
                let response = await axios.get(`/get/products/${credit_product[i].value}`)
                document_body.innerHTML = "";
                $product = response.data.product;
                        document_body.innerHTML =
                            `<tr>
                            <td class="text-center">1</td>
                            <td class="text-center">${$product.name}</td>
                            <td class="text-center">${$product.cash_withdrawal_fee}</td>
                            <td class="text-center">${$product.annual_interest_rate}</td>
                            <td class="text-center">${$product.issuance_fee}</td>
                        </tr>`;
                        ebModal.style.display = "block";

                })
            }
        // When the user clicks on <span> (x), close the modal
        ebSpan.onclick = function() {
            ebModal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == ebModal) {
                ebModal.style.display = "none";
            }
        }

    </script>
@endpush
