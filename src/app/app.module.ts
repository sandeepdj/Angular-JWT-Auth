import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';


import { AppComponent } from './app.component';
 
import { 
  LoginComponent,
  HeaderComponent
 } from './components/index';

import { 
  DashboardComponent,
  HomeComponent,
} from './modules/index';

import { AppGlobals } from './shared/app.global';

import { AppRoutingModule } from './app.router';

//Services
//import { AuthService } from './services/authentication.service';

import { AuthService, AuthGuard } from './services/index';
 

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HeaderComponent,
    DashboardComponent,
    HomeComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule
    
  ],
  providers: [
    AuthGuard,
    AuthService,
    AppGlobals
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
