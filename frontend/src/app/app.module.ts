import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule, routingComponents } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { FindUsersComponent } from './views/find-users/find-users.component';
import { CreateUserComponent } from './views/create-user/create-user.component';
import { EditUserComponent } from './views/edit-user/edit-user.component';
import { DeleteUserComponent } from './views/delete-user/delete-user.component';
import { NavbarComponent } from './views/misc/navbar/navbar.component';
import { GetUserEmailComponent } from './views/get-user-email/get-user-email.component';
import { GetUserRutComponent } from './views/get-user-rut/get-user-rut.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations'
@NgModule({
  declarations: [
    AppComponent,
    routingComponents,
    FindUsersComponent,
    CreateUserComponent,
    EditUserComponent,
    DeleteUserComponent,
    NavbarComponent,
    GetUserEmailComponent,
    GetUserRutComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    BrowserAnimationsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
