import { AsyncPipe, NgFor } from "@angular/common";
import { ChangeDetectionStrategy, Component, inject } from "@angular/core";
import { UsersApiService } from "../user-api.service";
import { UsersService } from "../users.sevice";
import { UserCardComponent } from "./user-card/user-card.component";
import { CreateUserFormComponent } from "../create-user-form/create-user-form.component";
import { MatIconModule } from "@angular/material/icon";
import { MatDialog } from "@angular/material/dialog";
import { CreateUserModalComponent } from "./create-user-modal/create-user-modal";
import { MatButton, MatButtonModule } from "@angular/material/button";
import { ReactiveFormsModule } from "@angular/forms";
import { MatInputModule } from "@angular/material/input";
import { MatFormFieldModule } from "@angular/material/form-field";
// import { Store } from "@ngrx/store";
// import { selectUsers } from "./store/users.selectors";
// import { UsersActions } from "./store/user.actions";
export interface User{
  
    "id": number,
    "name": string,
    "username"?: string,
    "email": string,
    
    "address"?: {
      "street": string,
      "suite": string,
      "city": string,
      "zipcode": string,

      "geo": {
        "lat": string,
        "lng": string,
      }
    },
    
    "phone"?: string,
    "website": string,

    "company": {

      "name": string,
      "catchPhrase"?: string,
      "bs"?: string,
    }
  
}

@Component({
  selector: 'app-users-list',
  templateUrl: './users-list.component.html',
  styleUrl: './users-list.component.scss',
  standalone: true,
  imports: [
    NgFor,
    UserCardComponent,
    AsyncPipe,
    CreateUserFormComponent,
    ReactiveFormsModule, MatInputModule,MatFormFieldModule,MatButtonModule,MatIconModule
  ],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class UsersListComponent {
  readonly UsersApiService = inject(UsersApiService);
  readonly usersService = inject(UsersService);
  // private readonly store = inject(Store)
  // public readonly users$ = this.store.select(selectUsers);

  constructor(public dialog: MatDialog) {
    this.UsersApiService.getUsers().subscribe((response: any) => {
      this.usersService.setUser(response);
      // this.store.dispatch(UsersActions.set({ users: response }));
    });
  }

  deleteUser(id: number) {
    this.usersService.deleteUser(id);
    // this.store.dispatch(UsersActions.delete({ id }));
  }

  editUser(user: any) {
    this.usersService.editUser({
      ...user,
      company: {
        name: user.companyName,
      },
    });
    // this.store.dispatch(UsersActions.edit({ user }));
  }

  public createUser(formData: any) {
    this.usersService.createUser({
      id: new Date().getTime(),
      name: formData.name,
      email: formData.email,
      website: formData.website,
      company: {
        name: formData.companyName,
      },
    });
    // this.store.dispatch(
    //   UsersActions.create({
    //     user: {
    //       id: new Date().getTime(),
    //       name: formData.name,
    //       email: formData.email,
    //       website: formData.website,
    //       company: {
    //         name: formData.companyName,
    //       },
    //     },
    //   })
    // );
  }


  openCreateUserModal(): void {
    const dialogRef = this.dialog.open(CreateUserModalComponent);

    dialogRef.afterClosed().subscribe((result) => {
      if (result) {
           this.usersService.createUser(result);
      }
    });
  }
}


