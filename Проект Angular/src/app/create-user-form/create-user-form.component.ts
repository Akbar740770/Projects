import { Component, EventEmitter, Output, } from "@angular/core";
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { MatInputModule } from '@angular/material/input';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
@Component({
  selector: 'app-create-user-form',
  standalone: true,
  templateUrl: './create-user-form.html',
  styleUrl: './create-user-form.scss',
  imports: [ReactiveFormsModule, MatInputModule,MatFormFieldModule,MatButtonModule,MatIconModule],
})
export class CreateUserFormComponent {
  @Output()

  createUserOuput = new EventEmitter();

  public form = new FormGroup({
    name: new FormControl('', [Validators.required]),
    email: new FormControl('', [Validators.required, Validators.email]),
    website: new FormControl('', [Validators.required]),
    companyName: new FormControl('', [Validators.required]),
  });

  public submitForm(): void {
    this.createUserOuput.emit(this.form.value);
    this.form.reset();
  }
}