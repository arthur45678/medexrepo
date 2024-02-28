<span>
    @if ($label)
        <label for="{{$selectName}}" class="mb-0">
            <strong>{{$label}}</strong>
        </label>
    @endif

    <select class="form-control with-search" name="{{$selectName}}" id="{{$selectName}}" {{$setFormIfExists()}}>
        <option value="">ընտրել {{$label}}-ն</option>
        @forelse ($options as $item)
            {{-- <option value="{{$item->id}}" {{old($selectName, $value) === "$item->id" ? 'selected' : ''}}> --}}
            {{-- <option value="{{$item->id}}" {{$isSelected($item->id) ? 'selected' : ''}}> --}}
            {{-- <option value="{{$item->id}}" {{$setSelectedOption($item->id)}}> --}}
            <option value='{{$getOption($item)}}' {{$setSelectedOption($getOption($item))}}>
                {{$item->name}}
            </option>
        @empty
        @endforelse
    </select>

    @if ($session())
        @error(Str::replaceFirst('[]', "", $selectName))
            <em class="error text-danger">{{$message}}</em>
        @enderror
    @else
        <em class="error text-danger" data-input="{{$selectName}}"></em>
    @endif
</span>
