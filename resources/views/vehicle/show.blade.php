<div class="modal-body">
    <div class="product-card">
        <div class="row">
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Vehicle ID')}}</h6>
                    <p class="mb-20">{{ vehiclePrefix().$vehicle->vehicle_id}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Vehicle Type')}}</h6>
                    <p class="mb-20">{{!empty($vehicle->types)?$vehicle->types->type:'-'}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Vehicle Name')}}</h6>
                    <p class="mb-20">{{$vehicle->name}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Vehicle Model')}}</h6>
                    <p class="mb-20">{{$vehicle->model}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Engine Type')}}</h6>
                    <p class="mb-20">{{$vehicle->engine_type}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Engine Number')}}</h6>
                    <p class="mb-20">{{$vehicle->engine_no}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('License Plate')}}</h6>
                    <p class="mb-20">{{$vehicle->license_plate}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Registration Expiry Date')}}</h6>
                    <p class="mb-20">{{$vehicle->registration_expiry_date}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Color')}}</h6>
                    <p class="mb-20">{{$vehicle->color}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Document')}}</h6>
                    <p class="mb-20">
                        @if(!empty($vehicle) && !empty($vehicle->document))
                            <a href="{{asset(Storage::url('upload/document'.'/'.$vehicle->document))}}"
                               target="_blank">{{$vehicle->document}}</a>
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-12">
                <div class="detail-group">
                    <h6>{{__('notes')}}</h6>
                    <p class="mb-20">{{$vehicle->notes}}</p>
                </div>
            </div>
        </div>
    </div>
</div>



