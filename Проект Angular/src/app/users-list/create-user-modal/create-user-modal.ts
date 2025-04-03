
import { Component, inject } from "@angular/core";
import { FormControl, FormGroup, ReactiveFormsModule } from "@angular/forms";
import { MatButtonModule } from "@angular/material/button";
import { MAT_DIALOG_DATA, MatDialogModule, MatDialogRef } from "@angular/material/dialog";
import { MatFormFieldModule } from "@angular/material/form-field";
import { MatIconModule } from "@angular/material/icon";
import { MatInputModule } from "@angular/material/input";
import { User } from "../users-list.component";

@Component({
  selector: 'app-create-user-modal',
  templateUrl: './create-user-modal.html',
  standalone: true,
  imports: [
    ReactiveFormsModule,
    MatInputModule,
    MatFormFieldModule,
    MatButtonModule,
    MatIconModule,
    MatDialogModule,
  ],
})
export class CreateUserModalComponent {
  readonly data = inject<{user: User}>(MAT_DIALOG_DATA);
  readonly dialogRef = inject(MatDialogRef<CreateUserModalComponent>);
  
    public form = new FormGroup({
      name: new FormControl(''),
      email: new FormControl(''),
      website: new FormControl(''),
      companyName: new FormControl(''),
    });

  
    submitForm() {
      this.dialogRef.close(this.form.value);
    }
  }
  
  
  
