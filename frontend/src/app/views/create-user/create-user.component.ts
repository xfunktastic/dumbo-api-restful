import { Component } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-create-user',
  templateUrl: './create-user.component.html',
  styleUrls: ['./create-user.component.css'],
})
export class CreateUserComponent {

  createUser: FormGroup;

  constructor(private ApiService: ApiService, private router: Router) {
    this.createUser = new FormGroup({
      rut_dni: new FormControl(),
      name: new FormControl(),
      lastname: new FormControl(),
      email: new FormControl(),
      points: new FormControl(),
    });
  }

  async createUserClick(){
    await this.ApiService.createUser(this.createUser.value);
  }


}
