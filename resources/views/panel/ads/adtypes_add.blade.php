@extends('panel.layout.app')
@section('title', __('Add or Edit Ad Types'))
@section('additional_css')
@endsection
@section('content')
    <div class="page-header" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 items-center">
                <div class="col">
					<div class="hstack gap-1">
						<a href="{{ LaravelLocalization::localizeUrl( route('dashboard.index') ) }}" class="page-pretitle flex items-center">
							<svg class="!me-2 rtl:-scale-x-100" width="8" height="10" viewBox="0 0 6 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.45536 9.45539C4.52679 9.45539 4.60714 9.41968 4.66071 9.36611L5.10714 8.91968C5.16071 8.86611 5.19643 8.78575 5.19643 8.71432C5.19643 8.64289 5.16071 8.56254 5.10714 8.50896L1.59821 5.00004L5.10714 1.49111C5.16071 1.43753 5.19643 1.35718 5.19643 1.28575C5.19643 1.20539 5.16071 1.13396 5.10714 1.08039L4.66071 0.633963C4.60714 0.580392 4.52679 0.544678 4.45536 0.544678C4.38393 0.544678 4.30357 0.580392 4.25 0.633963L0.0892856 4.79468C0.0357141 4.84825 0 4.92861 0 5.00004C0 5.07146 0.0357141 5.15182 0.0892856 5.20539L4.25 9.36611C4.30357 9.41968 4.38393 9.45539 4.45536 9.45539Z"/>
							</svg>
							{{__('Back to dashboard')}}
						</a>
						<a href="{{route('dashboard.admin.ad_types.adTypes')}}" class="page-pretitle flex items-center">
							/ {{__('Ad Types')}}
						</a>
					</div>
                    <h2 class="page-title mb-2">
                        {{__('Add or Edit Ad Types')}}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body pt-6">
        <div class="container-xl">
			<div class="row">
				<div class="col-md-8 mx-auto">
					<form id="page_form" onsubmit="return addTypeSave({{$ad_type!=null ? $ad_type->id : null}});" action="" enctype="multipart/form-data">

						<div class="mb-[20px]">
							<label class="form-label">
								{{__('Ad Type Title')}}
								<x-info-tooltip text="{{__('Add a ad type title. Example: Privacy Policy.')}}" />
							</label>
							<input type="text" class="form-control" id="title" name="title" value="{{$ad_type!=null ? $ad_type->title : null}}">
						</div>
						<div class="mb-[20px]">
							<label class="form-label">
								{{__('Ad Type')}}
								<x-info-tooltip text="{{__('Where this ad shown?')}}" />
							</label>
							<select name="type" id="type" class="form-control">
								@foreach ($ad_type_enums as $enum)
									@foreach ($enum as $name => $value)
										<option value="{{ $value }}" {{$ad_type!=null && $ad_type->type == $value ? 'selected' : null}}>{{ $name }}</option>
									@endforeach
								@endforeach
							</select>
						</div>
						
						<button form="page_form" id="page_button" class="btn btn-primary !py-3 w-100">
							{{__('Save')}}
						</button>
					</form>
				</div>
			</div>
        </div>
    </div>

@endsection

@section('script')
	<script src="/assets/js/panel/ads.js"></script>

@endsection
