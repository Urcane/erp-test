
    <div class="modal fade" id="modal_detail_item" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body mx-5 mx-lg-15 mb-7">
                    <div class="col-lg-12 text-center mb-9">
                        <span class="fs-1 fw-bolder text-dark d-block mb-1">Detail Item</span>
                        <span class="fs-1 text-dark d-block mb-1">Information item in Bill of Quantity</span>
                    </div>
                    <div class="scroll-y me-n10 pe-10" id="modal_status_item_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_status_item_header"
                        data-kt-scroll-wrappers="#modal_status_item_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-9">

                                <div class="row mb-9">

                                    <!-- Tambahkan atribut "data-url" pada select item untuk menyimpan URL endpoint untuk mengambil data jenis dan merek item -->
                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Nama Item</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="good_name" id="good_name" disabled>
                                    </div>

                                    <!-- Tambahkan atribut "data-url" pada select jenis item -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Jenis Item</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="good_type" id="good_type" disabled>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>

                                    <!-- Tambahkan atribut "data-url" pada select merek -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Merek</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="merk" id="merk" disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Detail Item inventory</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text"
                                            name="detail" id="detail" disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="d-flex align-items-center fs-6 form-label mb-2">
                                            <span class=" fw-bold">Spesification</span>
                                        </label>
                                        <input class="form-control form-control-solid" type="text" disabled
                                            name="spesification" id="spesification">
                                    </div>


                                    <div class="col-lg-12 mb-3">
                                        <div class="separator my-3"></div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Quantity</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid "
                                                    readonly="readonly" disabled
                                                    name="quantity" id="quantity">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Tipe Unit</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid "
                                                    readonly="readonly" disabled name="unit"
                                                    id="unit">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="separator my-3"></div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Rute Pengiriman</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text"
                                                    name="delivery_route" id="delivery_route" disabled>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Tipe Pengiriman</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text"
                                                    name="delivery_type" id="delivery_type" disabled>
                                            </div>

                                            <div class="col-lg-6 col-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Harga Beli</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid " disabled
                                                    name="purchase_price" id="purchase_price">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Jasa antar</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid" disabled
                                                    name="purchase_delivery"
                                                    id="purchase_delivery_charge">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Markup Price</label>
                                                <div class="position-relative">
                                                    <div class="position-absolute top-0"></div>
                                                    <input type="number" disabled="disabled"
                                                        class="form-control form-control-solid"
                                                        name="markup" id="markup">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Lokasi Barang</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text" disabled
                                                    name="purchase_from" id="purchase_from">
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class="fw-bold">Toko Referensi / Suplier</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" disabled
                                                    name="purchase_reference" id="purchase_reference">
                                            </div>

                                            <div class="col-lg-8 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Jenis Pembayaran</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="text" disabled
                                                    name="payment_type" id="payment_type">
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                                    <span class=" fw-bold">Batas Waktu</span>
                                                </label>
                                                <input class="form-control form-control-solid" type="number" disabled
                                                    name="purchase_validity" id="purchase_validity">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end ">
                                        <div class="w-20 me-10 mt-5">
                                            <span class="fw-bold">Total Amount : Rp. <span
                                                    id="total"></span></span>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3 row">
        <label class="fs-6 form-label mb-2" for="itemable_bill_of_quantity_id col-lg-12">
            <span class="required fw-bold">Bill for Quantity</span>
        </label>
        <select class="drop-data form-select form-select-solid col-lg-12"
            data-control="itemable_bill_of_quantity_id" required
            name="itemable_bill_of_quantity_id" id="itemable_bill_of_quantity_id" @if (($procurement->itemable_bill_of_quantity_id  ?? old('itemable_bill_of_quantity_id ')))
                disabled
            @endif>
            @if (($procurement->itemable_bill_of_quantity_id ?? old('itemable_bill_of_quantity_id')) == null)
                <option value="" selected hidden disabled>Select BOQ Number
                </option>
            @endif
            @foreach ($boq as $data)
                <option value="{{ $data->id }}"
                    @if (($procurement->itemable_bill_of_quantity_id  ?? old('itemable_bill_of_quantity_id ')) == $data->id) selected @endif>
                    {{ $data->id . ", " .$data->customerProspect->prospect_title }}</option>
            @endforeach
        </select>
        <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <div id="main-form" class="col-lg-12 @if (($procurement->itemable_bill_of_quantity_id ?? old('itemable_bill_of_quantity_id')) == null) d-none @endif">
        <div class="row">
            <div class="col-lg-4">
                <label class="d-flex align-items-center fs-6 form-label mb-2"
                    for="type">
                    <span class="required fw-bold">Procurement Type</span>
                </label>
                <select class="drop-data form-select form-select-solid" data-control="type" required
                    name="type" id="type" @if($procurement->type ?? old('type')) disabled @endif>
                    @if (($procurement->type ?? old('type')) == null)
                        <option value="" selected hidden disabled>Select procurement type</option>
                    @endif
                    @foreach ($dataProcurementType as $option)
                        <option value="{{ $option }}" @if (($procurement->type ?? old('type')) == $option) selected @endif>
                            {{ $option }}</option>
                    @endforeach
                </select>

                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="d-flex align-items-center fs-6 form-label mb-2" for="no_pr">
                    <span class="required fw-bold">No. Procurement</span>
                </label>
                <input type="number" id="no_pr" class="form-control form-control-solid"
                    placeholder="No. Procurement" required value="{{$procurement->no_pr ?? old("no_pr")}}" @if(($procurement->no_pr ?? old("no_pr"))) disabled @endif name="no_pr">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="d-flex align-items-center fs-6 form-label mb-2" for="allocation">
                    <span class="required fw-bold">Allocation</span>
                </label>
                <input type="text" id="allocation" class="form-control form-control-solid"
                    placeholder="Procurement allocation" required value="{{$procurement->allocation ?? old("allocation")}}" @if(($procurement->allocation ?? old("allocation"))) disabled @endif name="allocation">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="d-flex align-items-center fs-6 form-label mb-2"
                    for="ref_po_spk_pks">
                    <span class="required fw-bold">Ref PO/SPK/PKS Pelanggan</span>
                </label>
                <input type="text" id="ref_po_spk_pks"
                    class="form-control form-control-solid"
                    placeholder="Ref PO/SPK/PKS Pelanggan" required value="{{$procurement->ref_po_spk_pks ?? old("ref_po_spk_pks")}}" @if(($procurement->ref_po_spk_pks ?? old("ref_po_spk_pks"))) disabled @endif name="ref_po_spk_pks">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="d-flex align-items-center fs-6 form-label mb-2" for="ref_ph">
                    <span class="required fw-bold">Ref PH</span>
                </label>
                <input type="text" id="ref_ph" class="form-control form-control-solid"
                    placeholder="Ref PH" required value="{{$procurement->ref_ph ?? old("ref_ph")}}" @if(($procurement->ref_ph ?? old("ref_ph"))) disabled @endif name="ref_ph">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="d-flex align-items-center fs-6 form-label mb-2" for="requester">
                    <span class="required fw-bold">Requester</span>
                </label>
                <select class="drop-data form-select form-select-solid"
                    data-control="select2" required
                    name="requester" id="requester" @if (($procurement->requester ?? old('requester')))
                        disabled
                    @endif>
                    @if (($procurement->requester ?? old('requester')) == null)
                        <option value="" selected hidden disabled>Select Requester
                        </option>
                    @endif
                    @if (($procurement->requester ?? old('requester')) == null)
                        @foreach ($users as $data)
                            <option value="{{ $data->id }}"
                                @if (($procurement->requester  ?? old('requester ')) == $data->id) selected @endif>
                                {{ $data->name }}</option>
                        @endforeach
                    @else
                        <option>{{$procurement->requesterUser->name}}</option>
                    @endif
                </select>
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="col-lg-4 mb-3" id="customer_input">
                <label class="d-flex align-items-center fs-6 form-label mb-2" for="customer">
                    <span class="required fw-bold">Customer</span>
                </label>
                <input type="text" id="customer" class="form-control form-control-solid"
                    placeholder="Nama Calon Pelanggan" required value="{{$procurement->customer ?? old("customer")}}" @if(($procurement->customer ?? old("customer"))) disabled @endif name="customer">
            </div>
            <div class="col-lg-4 mb-3">
                <label class="d-flex align-items-center fs-6 form-label mb-2"
                    for="request_date">
                    <span class="required fw-bold">Tanggal Request</span>
                </label>
                <input type="date" id="request_date"
                    class="form-control form-control-solid" required value="{{$procurement->request_date ?? old("request_date")}}" @if(($procurement->request_date ?? old("request_date"))) disabled @endif name="request_date">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="d-flex align-items-center fs-6 form-label mb-2"
                    for="delivery_location">
                    <span class="required fw-bold">Lokasi Pengiriman</span>
                </label>
                <input type="text" id="delivery_location"
                    class="form-control form-control-solid" placeholder="Lokasi Pengiriman"
                    required value="{{$procurement->delivery_location ?? old("delivery_location")}}" @if(($procurement->delivery_location ?? old("delivery_location"))) disabled @endif name="delivery_location">
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
        </div>
        <hr class="my-10">
        @if (($procurement->itemable_bill_of_quantity_id ?? old('itemable_bill_of_quantity_id')) == null)
            <div class="col-lg-6">
                <h4>Item From BOQ</h4>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table align-top table-striped border table-rounded gy-5"
                        id="kt_table_item">
                        <thead class="">
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase">
                                <th class="text-center w-50px">#</th>
                                <th class="w-50px text-center">#</th>
                                <th class="w-200px">Name</th>
                                <th class="w-200px">Spesification</th>
                                <th class="w-200px">Quantity</th>
                                <th class="">Price</th>
                                <th class="">Jasa Antar</th>
                                <th class="">Total Price</th>
                                <th class="">Markup Price</th>
                                <th class="w-50px text-center">#</th>
                            </tr>
                        </thead>
                        <tbody class="fs-7">
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    <script>
        @if (!($procurement->itemable_bill_of_quantity_id  ?? old('itemable_bill_of_quantity_id ')))
            $("#type").change(function() {
                var type = $(this).val()
                if (type == "Inventory") {
                    $("#customer_input").find("input").remove();
                    $("#customer_input").append(`
                    <select id="select_customer" class="drop-data form-select form-select-solid" data-control="select2" required name="customer" data-dropdown-parent="#kt_modal_edit_lead">
                        <option value="" selected hidden disabled>Select Warehouse</option>
                        @foreach ($dataWarehouse as $warehouse)
                            <option value="{{$warehouse->name}}" data-id="{{$warehouse->id}}">{{$warehouse->name}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="warehouse_id" id="warehouse_id">
                    `)

                    $("#select_customer").change(function() {
                        var id = $("#select_customer option:selected").data("id")
                        console.log($(this), id);
                        $("#warehouse_id").val(id)
                    })
                } else {
                    $("#customer_input").find("select").remove();
                    $("#customer_input").find("input").remove();
                    $("#customer_input").append(`
                    <input type="text" id="customer" class="form-control form-control-solid"
                        placeholder="Nama Calon Pelanggan" required value="{{$procurement->customer ?? old("customer")}}" @if(($procurement->customer ?? old("customer"))) disabled @endif name="customer">
                    `)
                }
            })
        @endif
        function getDetail(id) {
            $.ajax({
                url: "{{ route('com.procurement.getDetailItem') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                data: {
                    id: id,
                },
                success: function(data) {
                    $("#good_name").val(data.data.inventory_good.good_name)
                    $("#good_type").val(data.data.inventory_good.good_type)
                    $("#merk").val(data.data.inventory_good.merk)
                    $("#detail").val(data.data.inventory_good.description)
                    $("#spesification").val(data.data.inventory_good.spesification)
                    $("#quantity").val(data.data.quantity)
                    $("#delivery_route").val(data.data.delivery_route)
                    $("#delivery_type").val(data.data.delivery_type)
                    $("#purchase_price").val(data.data.purchase_price)
                    $("#purchase_delivery_charge").val(data.data.purchase_delivery_charge)
                    $("#markup").val(data.data.markup_price)
                    $("#quantity").val(data.data.quantity)
                    $("#purchase_form").val(data.data.purchase_form)
                    $("#purchase_reference").val(data.data.purchase_reference)
                    $("#payment_type").val(data.data.payment_type)
                    $("#purchase_validity").val(data.data.purchase_validity)
                    $("#total").html(data.data.total_price)
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                }
            })
        }

        $('#itemable_bill_of_quantity_id').change(function() {
            var id = $(this).val()
            $('#main-form').removeClass("d-none")

            table(id)
        })

        function table(id) {
            generateDatatable({
                elementName: "#kt_table_item",
                ajaxLink: "{{ route('com.procurement.getTableItemFromBOQ') }}",
                filters: {
                    id: id,
                },
                columnData: [{
                        data: 'DT_RowChecklist',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'good_name'
                    },

                    {
                        data: 'spesification'
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'purchase_price'
                    },
                    {
                        data: 'purchase_delivery_charge'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'markup_price'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        }
    </script>
