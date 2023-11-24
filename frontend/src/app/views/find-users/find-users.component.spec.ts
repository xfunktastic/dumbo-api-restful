import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FindUsersComponent } from './find-users.component';

describe('FindUsersComponent', () => {
  let component: FindUsersComponent;
  let fixture: ComponentFixture<FindUsersComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [FindUsersComponent]
    });
    fixture = TestBed.createComponent(FindUsersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
