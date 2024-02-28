@extends('layouts.cardBase')

@section('css')
<link rel="stylesheet" href="{{mix('/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('card-header')
Բժիշկներ | {{$user->full_name}}
<div class="card-header-actions d-flex">

    @can('update users')
    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary mr-2">
        <x-svg icon="cui-pencil" />
    </a>
    @endcan
    @cannot('update users')
        <button class="btn btn-secondary mr-2" disabled><x-svg icon="cui-pencil" /></button>
    @endcannot

    @can('update users')
    <button href="#"  class="btn btn-primary" data-target="#file-attachment-modal" data-toggle="modal">
        <x-svg icon="cui-paperclip" />
    </button>
    @endcan
    @cannot('update users')
        <button class="btn btn-secondary mr-2" disabled><x-svg icon="cui-paperclip" /></button>
    @endcannot
</div>

<!-- modal: attach new file to patient's document -->
<x-modal modal-id="file-attachment-modal" title="Կցել փաստաթուղթ">
    <form action='{{route("users.store_file")}}' method="POST" id="file-attachment-form"
    class="ajax-submitable has-files" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <ul class="list-group">
            <li class="list-group-item">
                <x-forms.text-field label='Ընտրել փաստաթուղթը' name='attachments' type='file' validationType='ajax' />
            </li>
            <li class="list-group-item">
                <x-forms.text-field label='Փաստաթղթի անվանումը' name='attachment_comments[]' type='text' validationType='ajax' />
            </li>
            @include('shared.forms.list_group_item_submit', ["has_files" => true])
        </ul>
    </form>
</x-modal>
@endsection

@section('card-content')
<div class="nav-tabs-boxed">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home"
                aria-selected="true">
                Անձնական տվյալներ
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile"
                aria-selected="false">
                Կից Ֆայլեր
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="home-1" role="tabpanel">
            <div class="row">
                <div class="col-md-2">
                    <div>
                        <img src="{{asset("/assets/img/avatars/patient.jpg")}}" alt="Patient" class="img img-fluid" />
                    </div>
                    <div>
                        <img src="{{asset("/assets/img/barcode.svg")}}" alt="Patient" class="img img-fluid">
                    </div>
                </div>
                <div class="col-md-10">
                    <form action="?">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Անուն</label>
                                <input value="{{$user->f_name}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ազգանուն</label>
                                <input value="{{$user->l_name}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Հայրանուն</label>
                                <input value="{{$user->p_name}}" type="text" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Ծննդյան թիվը</label>
                                <input value="{{date('d/m/Y',strtotime($user->birth_date))}}" type="text"
                                    class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Հծհհ</label>
                                <input value="{{$user->soc_card}}" type="number" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Էլ․ հասցե</label>
                                <input value="{{$user->email}}" type="email" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Մարզ</label>
                                <input value="{{$user->residence_region}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Քաղաք/Գյուղ</label>
                                <input value="{{$user->town_village}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-5">
                                <label>Փողոց/Շենք</label>
                                <input value="{{$user->street_house}}" type="text" class="form-control" disabled />
                            </div>
                            {{-- <div class="form-group col-md-1">
                                <label>Շենք</label>
                                <input value="9/1" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-2">
                                <label>Բնակարան</label>
                                <input value="24" type="number" class="form-control" disabled />
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Հեռ․ Բջջային</label>
                                <input value="{{$user->m_phone}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Հեռ․ Քաղաք</label>
                                <input value="{{$user->c_phone}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ազգությունը</label>
                                <input value="{{$user->nationality}}" type="text" class="form-control" disabled />
                            </div>
                            {{-- <div class="form-group col-md-2">
                                <label>Այրան Կարգ</label>
                                <input value="A+" type="text" class="form-control" disabled />
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="profile-1" role="tabpanel">
            <table class="table table-striped datatable-default">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Փաստաթղթի անուն</th>
                        <th>Ֆայլի անուն</th>
                        <th class="text-center">Գործողություն</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($user->attachments as $a_key => $attachment)
                    @php
                        // $index_route_name = $attachment->directory.'/'.$attachment->attachment_name;
                        // $link = $attachment->full_path;
                        $show_ext = ['pdf','txt', 'jpg', 'jpeg', 'png'];
                        $btn_text = in_array($attachment->extension, $show_ext)  ? 'դիտել' : 'բեռնել';
                    @endphp
                    <tr>
                        <td><strong>{{$a_key + 1}}</strong></td>
                        <td>{{$attachment->attachment_comment ?? '---'}}</td>
                        <td>{{$attachment->attachment_name}}</td>
                        <td class="d-flex justify-content-around">
                            <a href='{{$attachment->full_path}}' target="_blank" class="btn btn-primary">
                                <x-svg icon="cui-external-link" />
                                {{$btn_text}}
                            </a>
                            @if ($attachment->user_id == auth()->id())
                            <form action="{{route('attachments.delete',['attachable'=>$attachment])}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger mr-1 btn-confirmable" data-confirm="Դուք պատրաստվում եք հեռացնել ընտրված փաստաթուղթը:">
                                    <x-svg icon="cui-delete" />
                                    ջնջել
                                </button>
                            </form>
                            @endif

                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{mix('/js/jquery.js')}}"></script>
<script src="{{mix('/js/datatables.js')}}"></script>
@endsection
