import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { firstValueFrom } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private endpoint:string='http://127.0.0.1:8000/api'

  constructor(private HttpClient:HttpClient) {
 }
 loginUser(FormValue:any){
  return firstValueFrom(this.HttpClient.post<any>(this.endpoint+'/login',FormValue));
 }

}
