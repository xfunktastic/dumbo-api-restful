import { Component } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { Form, FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-get-user-email',
  templateUrl: './get-user-email.component.html',
  styleUrls: ['./get-user-email.component.css']
})
export class GetUserEmailComponent {
  user: any[] = [];

}
