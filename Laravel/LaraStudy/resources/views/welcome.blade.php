@extends('layouts.app')
{{-- 자식 뷰를 정의할 때 @extends지시어를 사용해 하위 페이지가 어느 레이아웃을 상속 받을지 명시. --}}

@section('content')
{{-- 블레이트 레이아웃을 상속받는 뷰는 @section 지시어를 이용해 레이아웃의 섹션에 컨텐츠를 삽입할 수 있다. --}}
{{-- 이 세션들의 컨텐츠는 @yield를 통해 레이아웃에 명시된다 --}}

    <h2>블레이드 템플릿 파일을 재 welcome</h2>
@endsection
