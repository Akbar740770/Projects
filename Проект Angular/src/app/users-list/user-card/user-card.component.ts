import { Component, EventEmitter, inject, Input, Output } from "@angular/core";
import { MatDialog } from '@angular/material/dialog';
import { EditUserDialogComponent } from "../edit-user-dialog/edit-user-dialog.component";
import { MatDialogModule } from '@angular/material/dialog';
import { DeleteUserDialogComponent } from "../delete-user-dialog/delete-user-dialog.component";
import { MatSnackBar, MatSnackBarModule } from '@angular/material/snack-bar';
import { MatCardModule } from '@angular/material/card';
import { MatChipsModule } from '@angular/material/chips';
import { MatDialogActions } from "@angular/material/dialog";
import { MatButtonModule } from "@angular/material/button";
import { MatDividerModule } from '@angular/material/divider';
import { MatIconModule } from "@angular/material/icon";
import { customUpperCasePipe } from "../../pipes/upper-case.pipe";
import { RemoveDashesPipe } from "../../pipes/remove-dashes.pipe";
import { HoverShadowDirective } from "../../directives/hovershadow.directive";
import { MatTooltipModule } from '@angular/material/tooltip';


@Component({
  selector: 'app-user-card',
  templateUrl: './user-card.component.html',
  styleUrl: './user-card.component.scss',
  standalone: true,
  imports: [
    MatDialogModule,
    MatSnackBarModule,
    MatCardModule,
    MatChipsModule,
    MatButtonModule,
    MatDividerModule,
    MatIconModule,
    customUpperCasePipe,
    RemoveDashesPipe,
    HoverShadowDirective,
    MatTooltipModule,
  ],
})
export class UserCardComponent {
  @Input()
  user: any;

  @Output()
  deleteUser = new EventEmitter<number>();

  @Output()
  editUser = new EventEmitter();

  readonly dialog = inject(MatDialog);
  private snackBar = inject(MatSnackBar);

  openDialog(): void {
    const dialogRef = this.dialog.open(EditUserDialogComponent, {
      data: { user: this.user },
    });

    dialogRef.afterClosed().subscribe((editResult) => {
      this.editUser.emit(editResult);
    });
  }

  openDeleteDialog(): void {
    const dialogRef = this.dialog.open(DeleteUserDialogComponent, {
      width: '600px',
      data: { user: this.user },
    });

    dialogRef.afterClosed().subscribe((result) => {
      if (result) {
        this.deleteUser.emit(this.user.id);
        this.snackBar.open('Пользователь удален', 'OK', {
          duration: 3000,
        });
      } else {
        this.snackBar.open('Отмена', 'OK', {
          duration: 3000,
        });
      }
    });
  }
}

 // OnDeleteUser(userId: number) {
  //   this.deleteUser.emit(userId);
  // }