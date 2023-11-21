import { Component, Inject } from '@angular/core';
import { FormControl } from '@angular/forms';
import { ApiService } from '../../Services/api.service';
import { FormGroup } from '@angular/forms';
import { inject } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  form: FormGroup;
  ApiService = inject(ApiService);
  RouterService = inject(Router);
  constructor(){
    this.form = new FormGroup({
      username : new FormControl(),
      password : new FormControl(),
    });
  }
  async onSubmit(){
    const response=await this.ApiService.loginUser(this.form.value)
    if(!response.error){
      localStorage.setItem('token',response.token);
      this.RouterService.navigate(['/home']);
    }
  }
}
