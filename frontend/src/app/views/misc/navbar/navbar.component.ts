import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { inject } from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {

  router = inject(Router);

  onClickLogout(){
    localStorage.removeItem('token');
    this.router.navigate(['login']);
  }

}
