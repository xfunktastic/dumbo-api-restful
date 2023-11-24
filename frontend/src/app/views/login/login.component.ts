import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent{

  form:FormGroup
  loginObj: any = {
    "username":"",
    "password":""
  }

  constructor(private ApiService:ApiService, private router: Router) {
    this.form = new FormGroup({
      username : new FormControl(),
      password : new FormControl()
    });
  }

  async onSubmit(){
    const mensaje = await this.ApiService.login(this.form.value)
    if(!mensaje.error){
      localStorage.setItem("token",mensaje.token);
      this.router.navigate([
        'dashboard'
      ]);
    }
    if(mensaje.error){
      console.log(mensaje.error);
    }
  }
}
