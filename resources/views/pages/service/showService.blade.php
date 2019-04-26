@extends('layouts.services')

@section('content')
    <aside class="sidebar-left col-md-3 p-3">
        <ul class="list-items lvl-1">
            @foreach ($categories  as $categoryAside)
                <li class="list-item dropdown {{ Request::is('services/category/' . $categoryAside->slug) ? 'active' : '' }}">
                    <a class="link-def" href="services/category/{{$categoryAside->slug}}"
                       aria-expanded="false" aria-controls="collapseExample{{$categoryAside->id}}">{{$categoryAside->title}}</a>
                    <div class="collapse" id="collapseExample{{$categoryAside->id}}">
                        <ul class="list-items lvl-2">
                            @foreach ($categoryAside->service  as $serviceAside)
                                <li class="list-item {{ Request::is('services/service/' . $serviceAside->slug) ? 'active' : '' }}">
                                    <a class="link-def" href="services/service/{{$serviceAside->slug}}">{{$serviceAside->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>

    <div class="content col-12 col-md-9">
        <form action="{{route('page.service.search')}}" method="get" class="row">
            <div class="form-group col-5">
                <input type="text" class="form-control" placeholder="Введите название услуги" name="s" value="{{ isset($s) ? $s : '' }}">
            </div>
            <div class="form-group col-5">
                <input type="text" class="form-control" placeholder="Введите возраст" name="age" value="{{ isset($age) ? $age : '' }}">
            </div>
            <div class="form-group col-2">
                <button class="btn btn-success">Искать</button>
            </div>
        </form>
        <table class="table-responsive table table-custom">
            <thead>
            <tr style="text-align: left;">
                <th scope="col">Аватар</th>
                <th scope="col">Фио врача</th>
                <th scope="col">Филиалы</th>
                <th scope="col">Специализация</th>
                {{--<th scope="col">Примечание</th>--}}
                <th scope="col" class="d-none">Услуги</th>
                <th scope="col" class="d-none">Возраст</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($service->doctor as $doctor)
                <tr>
                    <td><div class="doc_item_img">
                            <a href="doctors/doctor/{{$doctor->slug}}"><img src="{{ $doctor->getImage() }}"></a>
                        </div>
                    </td>
                    <td><a href="doctors/doctor/{{$doctor->slug}}">{{ $doctor->name }}</a></td>
                    <td>{{ $doctor->getBranchTitle() }}</td>
                    <td>{{ $doctor->getSpecTitle() }}</td>
                    {{--<td class="text-left">{{ $doctor->getdescription() }}</td>--}}
                    <td class="d-none">{{ $doctor->getServiceTitle() }}</td>
                    <td class="d-none">
                        {{ $doctor->getServiceOldRange() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
       {{-- <div class="d-flex justify-content-center">
            {!! $service->doctor->links() !!}
        </div>--}}
    </div>
@endsection