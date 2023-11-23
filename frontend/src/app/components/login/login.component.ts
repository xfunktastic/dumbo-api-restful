import { Component } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  public form={
    username:null,
    password:null,
  }

  constructor() {}

  ngOnInit(): void {}

  submitLogin(){
    console.log(this.form);
  }

}
