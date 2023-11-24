import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { inject } from '@angular/core';
import { ApiService } from '../../../services/api.service';


@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {

  router = inject(Router);
  apiService =  inject(ApiService);

  onClickLogout(){
    localStorage.removeItem('token');
    this.router.navigate(['login']);
  }


}
