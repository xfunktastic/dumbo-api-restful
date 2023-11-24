import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { firstValueFrom } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private url:string = 'http://127.0.0.1:8000/api';

  constructor(private http:HttpClient) {
  }

  login(formValue: any) {
    return firstValueFrom(this.http.post<any>(this.url+'/login', formValue));
  }

}
