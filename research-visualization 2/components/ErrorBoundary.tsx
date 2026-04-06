import React, { Component, ErrorInfo, ReactNode } from 'react';

interface Props {
    children?: ReactNode;
    fallback?: ReactNode;
}

interface State {
    hasError: boolean;
}

export class ErrorBoundary extends Component<Props, State> {
    public state: State = {
        hasError: false
    };

    public static getDerivedStateFromError(_: Error): State {
        return { hasError: true };
    }

    public componentDidCatch(error: Error, errorInfo: ErrorInfo) {
        console.error("WebGL/Canvas Error caught by boundary:", error, errorInfo);
    }

    public render() {
        if (this.state.hasError) {
            if (this.props.fallback) {
                return this.props.fallback;
            }
            return (
                <div className="flex items-center justify-center w-full h-full bg-stone-100 rounded-lg border border-stone-200 p-6 text-center">
                    <div className="flex flex-col items-center">
                        <span className="text-stone-400 mb-2">
                            <svg xmlns="http://www.w3.org/warnings/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                        </span>
                        <p className="text-sm font-medium text-stone-500">3D Interactive Viewer Unavailable</p>
                        <p className="text-xs text-stone-400 mt-1 max-w-[200px]">Your browser or device does not support WebGL graphics.</p>
                    </div>
                </div>
            );
        }

        return this.props.children;
    }
}
