<!--
    this pahe is pane-content of Չմակագրված
    need params: $department $doctors $receivedReferrals
-->
<div class="tab-pane active" id="doc_pane_0" role="tabpanel">
    <div class="card">
        <div class="card-header">
            <h5 class="text-center">Չմակագրված հիվանդների ցանկ - {{date('d/m/Y')}}</h5>
        </div>

        <div class="card-body x-overflow-auto">
            <h6 class="card-title">բաժին՝ {{$department->name}}</h6>
            <table id="doc_table_0" class="table table-hover table-bordered" style="width:100%;">
                <thead class="thead-info">
                    <tr>
                        <th>№</th>
                        <th>Ամսաթիվ</th>
                        <th>Հիվանդ</th>
                        <th>Ծառ. կոդ/վճարման տեսակ</th>

                        <th class="text-center">Գործողություններ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receivedReferrals as $r_key => $item)
                        <tr data-url={{route("referrals.patients.received.show", $item->id)}}>
                            <td>{{$r_key + 1}} / {{$item->id}}</td>
                            <td>{{$item->created_at}}</td> <!-- date_with_diff -->
                            <td>{{$item->patient->full_name}}</td>
                            <td>
                                @forelse ($item->referral_services as $s_key => $service)
                                    <p title='{{$service->serviceable->name}}'>
                                        {{$s_key+1}}) {{$service->serviceable->code}} /
                                        {{__("enums.service_payment_type_enum.{$service->payment_type}")}}
                                    </p>
                                @empty
                                @endforelse
                            </td>

                            <td>
                                <form action='{{route("departments.queues.store")}}' id="qform_{{$r_key}}" method="POST" class="form-inline justify-content-center">
                                    @csrf
                                    <input type="hidden" name="referral_id" value="{{$item->id}}">
                                    {{-- <input type="hidden" name="patient_id" value="{{$item->patient->id}}"> --}}
                                    <x-forms.checkbox-radio pos="valign" id="urgent_{{$r_key}}" value="1"
                                        type="checkbox" name="is_urgent" label="Շտապ"/>

                                    <select name="select_user_id" class="form-control">
                                        <option value="">Ընտրել բժշկին</option>
                                        @foreach ($doctors as $doc)
                                        <option value="{{$doc->id}}">{{$doc->full_name}}</option>
                                        @endforeach
                                    </select>

                                    <button class="btn btn-info mr-1" type="submit">հերթագրել</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
                <tfoot class="thead-info">
                    <tr>
                        <th>№</th>
                        <th>Ամսաթիվ</th>
                        <th>Հիվանդ</th>
                        <th>Ծառ. կոդ/վճարման տեսակ</th>

                        <th class="text-center">Գործողություններ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
