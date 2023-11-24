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
import { GetUserComponent } from './views/get-user/get-user.component';
import { SidebarComponent } from './views/misc/sidebar/sidebar.component';
import { NavbarComponent } from './views/misc/navbar/navbar.component'
@NgModule({
  declarations: [
    AppComponent,
    routingComponents,
    FindUsersComponent,
    CreateUserComponent,
    EditUserComponent,
    DeleteUserComponent,
    GetUserComponent,
    SidebarComponent,
    NavbarComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
