### Notes on Assembly Language

**1. Introduction**
- **Low-Level Language:** Close to machine code, allowing for precise control over hardware.
- **Architecture-Specific:** Each processor has its own assembly language (e.g., Intel x86, ARM).
- **Mnemonics:** Uses symbolic names for operations (e.g., `MOV`, `ADD`, `SUB`) and memory locations.

**3. Basic Components of Assembly Language:**
- **Instruction Set:** The set of all operations that can be performed by a CPU (e.g., `MOV`, `ADD`, `JMP`).
- **Operands:** Values or addresses on which instructions operate (e.g., immediate values, register contents).
- **Registers:** Small storage locations inside the CPU used for calculations and data movement.
- **Memory Addressing:** Techniques to access data in memory, including direct, indirect, and indexed addressing.

**4. Common Assembly Instructions:**
- **Data Movement:**
  - `MOV dest, src`: Move data from source to destination.
  - `PUSH`: Push a value onto the stack.
  - `POP`: Pop a value from the stack.
  
- **Arithmetic Operations:**
  - `ADD dest, src`: Add source to destination.
  - `SUB dest, src`: Subtract source from destination.
  - `MUL`: Multiply values.
  - `DIV`: Divide values.

- **Control Flow:**
  - `JMP label`: Unconditional jump to a label.
  - `CMP reg, value`: Compare values in register and value.
  - `JE/JNE label`: Jump if equal/not equal.
  - `CALL`: Call a function or subroutine.
  - `RET`: Return from a function.

**5. Registers (x86 Example):**
- **General Purpose Registers:**
  - `EAX`: Accumulator for operations.
  - `EBX`: Base register.
  - `ECX`: Counter register (often used in loops).
  - `EDX`: Data register.
  
- **Special Purpose Registers:**
  - `ESP`: Stack pointer (points to the top of the stack).
  - `EBP`: Base pointer (used in function calls to track the stack frame).
  - `EIP`: Instruction pointer (holds the address of the next instruction).

**6. Memory Addressing Modes:**
- **Immediate Addressing:** The operand is a constant (e.g., `MOV EAX, 10`).
- **Register Addressing:** The operand is a register (e.g., `MOV EBX, EAX`).
- **Direct Addressing:** Accessing memory directly (e.g., `MOV EAX, [0x1234]`).
- **Indexed Addressing:** Using a register as an index to memory (e.g., `MOV EAX, [EBX + 4]`).

**7. Assembler and Linker:**
- **Assembler:** Converts assembly language code into machine code (binary).
- **Linker:** Combines object files into an executable, resolving symbols and addresses.

**8. Advantages of Assembly Language:**
- **Performance:** Efficient use of system resources (CPU, memory).
- **Control:** Direct control over hardware and system resources.
- **Optimization:** Critical for performance-critical applications, such as embedded systems or real-time systems.

**9. Disadvantages of Assembly Language:**
- **Complexity:** More difficult to learn and write than high-level languages.
- **Portability:** Code is not portable between different processor architectures.
- **Error-Prone:** Prone to human errors due to low-level details and complexity.

**10. Use Cases for Assembly Language:**
- **Embedded Systems:** Where resources are limited and performance is critical.
- **Operating Systems Development:** For low-level hardware control and performance optimization.
- **Device Drivers:** To interact with hardware at a low level.
- **Performance Optimization:** In areas where the performance of critical code sections is essential.

**11. Example of Simple Assembly Code (x86):**

```asm
section .data
    msg db 'Hello, World!', 0   ; Message to display
    msg_len equ $ - msg         ; Calculate the length of the message

section .bss
    hConsole resb 4             ; Handle for the console

section .text
    global _start               ; Entry point for the program
    extern GetStdHandle, WriteConsoleA, ExitProcess

_start:
    ; Get the console handle for STD_OUTPUT_HANDLE
    push 0xFFFFFFF5             ; STD_OUTPUT_HANDLE (-11)
    call GetStdHandle
    mov [hConsole], eax         ; Save the console handle

    ; Write the message to the console
    push 0                      ; Pointer to store number of chars written
    push msg_len                ; Length of the message
    push msg                    ; Address of the message
    push [hConsole]             ; Console handle
    call WriteConsoleA          ; Call the Windows API function to write to the console

    ; Exit the program
    push 0                      ; Exit code 0
    call ExitProcess            ; Exit the program

```
This is a simple assembly program that prints "Hello, World!" to the console using window32 Api calls.

**12. Assembly Program divided into three sections**
  - Example of Sum of two digits for 1 byts...
  - **Data Section** : The data section is used for declaring initialized data or constants. This data does not change at runtime. You can declare various constant values, file names, or buffer size, etc., in this section
      ```asm 
        section .data  
        msg db 'Sum of two numbers is: ', 0   ; comment : 0 is used for end of string 
      ```
 - **The Bass Section** : The bss section is used for declaring variables.
      ```asm
      section.bss
      sum resb 1  ; Reserve a byte for the sum, 1 byt = 8 bits, So 2^8 = 255 [00000000, 11111111 -> 8 times], so can store sum value upto 0 to 255 numbers
      sum resb 2  ; Reserve 2 byte for the sum, 2 byt = 16 bits, So 2^16 = 65535 [0000000000000000, 1111111111111111 -> 16 times] , so can store sum value upto 0 to 65535 numbers
      ```
  - **The text Section** : The text section is used for keeping the actual code. This section must begin with the declaration global _start, which tells the kernel where the program execution begins.
    ```asm
    section .text  
    global _start  

    _start:
        ; Initialize variables
        mov al, 5        ; Load value 5 into AL register
        add al, 3        ; Add value 3 to AL (sum = 5 + 3)
    
        ; Store the result in the sum variable
        mov [sum], al    ; Store the value in sum
    
        ; Print the message
        mov edx, len     ; Message length
        mov ecx, msg     ; Message to display
        mov ebx, 1       ; File descriptor (stdout)
        mov eax, 4       ; Syscall number (sys_write)
        int 0x80         ; Call kernel
    
        ; Exit the program
        mov eax, 1       ; Syscall number (sys_exit)
        xor ebx, ebx     ; Return code 0
        int 0x80         ; Call kernel
    
    len equ $ - msg
    ```
    
**13. Comments in Assembly Language**
  Assembly language comment begins with a semicolon (;). It may contain any printable character including blank.
  ```asm 
    ;This program displays a message on screen
    add eax, ebx     ; adds ebx to eax
  ```




