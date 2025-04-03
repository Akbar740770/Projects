import { Directive, HostBinding, HostListener, } from '@angular/core';

@Directive({
  selector: '[appHoverColor]', // Директива будет использоваться с атрибутом appHoverColor
  standalone: true,
})
export class HoverColorDirective {
  color = '#3c3c3b';

  @HostBinding('style.backgroundColor')
  get backgroundColor() {
    return this.color;
  }

  @HostListener('mouseenter')
  onMouseEnter() {
    this.color = '#f0ba4e';
  }

  @HostListener('mouseleave')
  onMouseLeave() {
    this.color = '#3c3c3b';
  }
}
