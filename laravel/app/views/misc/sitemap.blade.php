<hr>
<table style="width: 100%;">
    <tr>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15" style="font-weight: bold;">MAIN PAGES</td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15" style="font-weight: bold;">CONTACT US</td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15" style="font-weight: bold;">USER SECTION</td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15" style="font-weight: bold;">DISCLAIMERS</td>
    </tr>
    <tr>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('home') }}">Home</a></td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('home') }}">FAQ</a></td>
        @if(Auth::check())<td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('profile.writer.new', array('username' => Auth::user()->username)) }}">Write an Article</td>
        @else <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('login') }}">Login / Register</td> @endif
        <td width="20%" id="footerCatHeadingLink" align="left" height="15">Terms and Conditions</td>
    </tr>
       <tr>
           <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('forum') }}">Forum</a></td>
           <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('home') }}">Support</a></td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"></td>
        @if(Auth::check()) <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('profile.writer.newad', array('username' => Auth::user()->username)) }}">Sell Something</a></td> @else <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('login') }}"></td> @endif
    </tr>
      <tr>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('articles') }}">Articles</a></td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"></td>
          @if(Auth::check()) <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('profile', array('username' => Auth::user()->username)) }}">My Profile</a></td> @endif
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"></td>
    </tr>
      <tr>
          <td width="20%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('classifieds') }}">Classifieds</a></td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"></td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"></td>
        <td width="20%" id="footerCatHeadingLink" align="left" height="15"></td>
    </tr>
      <tr>
          <td width="25%" id="footerCatHeadingLink" align="left" height="15"><a href="{{ URL::route('galleries') }}">Galleries</a></td>
        <td width="25%" id="footerCatHeadingLink" align="left" height="15"></td>
        <td width="25%" id="footerCatHeadingLink" align="left" height="15"></td>
        <td width="25%" id="footerCatHeadingLink" align="left" height="15"></td>
    </tr>
</table>
<div class="spacer"></div>
<hr>