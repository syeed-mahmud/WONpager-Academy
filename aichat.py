import openai

def chat_with_bot():
    client = openai.OpenAI(
        base_url="https://api.groq.com/openai/v1",
        api_key="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"  # Ensure this is set properly
    )
    
    print("Chatbot: Hello! Type 'exit' to stop chatting.")
    while True:
        user_input = input("You: ")
        if user_input.lower() == 'exit':
            print("Chatbot: Goodbye!")
            break
        
        messages = [{"role": "user", "content": user_input}]
        response = client.chat.completions.create(
            model="deepseek-r1-distill-llama-70b",  # Match the model used in the response
            messages=messages,
            max_tokens=500,
        )

        # Extract the assistant's response
        assistant_reply = response.choices[0].message.content

        # **Filter out "thinking" text if present**
        if "<think>" in assistant_reply and "</think>" in assistant_reply:
            # Extract only the response after </think>
            assistant_reply = assistant_reply.split("</think>")[-1].strip()

        print(f"Chatbot: {assistant_reply}")

if __name__ == "__main__":
    chat_with_bot()
