<div class="modal-body">
    <div class="product-card">
        <div class="row">
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('ID')}}</h6>
                    <p class="mb-20">{{ !empty($driver)?driverPrefix().$driver->driver_id:'-' }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Name')}}</h6>
                    <p class="mb-20">{{$user->name}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Email')}}</h6>
                    <p class="mb-20">{{$user->email}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Phone Number')}}</h6>
                    <p class="mb-20">{{$user->phone_number}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Gender')}}</h6>
                    <p class="mb-20">{{!empty($driver)?$driver->gender:'-'}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Age')}}</h6>
                    <p class="mb-20">{{!empty($driver)?$driver->age:'-'}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Address')}}</h6>
                    <p class="mb-20">{{!empty($driver)?$driver->address:'-'}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Joining Date')}}</h6>
                    <p class="mb-20">{{ !empty($driver)?dateFormat($driver->joining_date):'-' }} </p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('License Number')}}</h6>
                    <p class="mb-20">{{!empty($driver)?$driver->license_number:'-'}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Issue Date')}}</h6>
                    <p class="mb-20">{{ !empty($driver)?dateFormat($driver->issue_date):'-'}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Expiration Date')}}</h6>
                    <p class="mb-20">{{!empty($driver)?dateFormat($driver->expiration_date):'-' }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Document')}}</h6>
                    <p class="mb-20">
                        @if(!empty($driver) && !empty($driver->document))
                            <a href="{{asset(Storage::url('upload/document'.'/'.$driver->document))}}"
                               target="_blank">{{$driver->document}}</a>
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('License')}}</h6>
                    <p class="mb-20">
                        @if(!empty($driver) && !empty($driver->license))
                            <a href="{{asset(Storage::url('upload/license'.'/'.$driver->license))}}"
                               target="_blank"> {{!empty($driver)?$driver->license:'-'}}</a>
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Reference')}}</h6>
                    <p class="mb-20">{{!empty($driver)?$driver->reference:'-'}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('notes')}}</h6>
                    <p class="mb-20">{{!empty($driver)?$driver->notes:'-'}}</p>
                </div>
            </div>
        </div>
    </div>
</div>



