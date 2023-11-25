import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { Form, FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-get-user-rut',
  templateUrl: './get-user-rut.component.html',
  styleUrls: ['./get-user-rut.component.css']
})
export class GetUserRutComponent{
  user: any[] = [];
  rutForm: FormGroup;

  constructor(private apiService: ApiService, private fb: FormBuilder) {
    this.rutForm = this.fb.group({
      rut: ['']
    });
  }

  onSubmit(): void {
    const rut = this.rutForm.value.rut;
    this.getUserRUT(rut);
  }

  getUserRUT(rut: string) {
    this.apiService.getRut(rut).subscribe((response: any) => {
      this.user = response.user;
      console.log(this.user);
    });
  }

}
