import { Component } from '@angular/core';
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
    const message = await this.ApiService.login(this.form.value);
    if(!message.error){
      localStorage.setItem("token", message.token);
      this.router.navigate(['/dashboard']);
    }
    if(message.error){
      console.log(message.error);
    }
  }
}
